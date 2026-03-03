<?php
include '../../../backend/admin/verif_admin.php';

$message      = '';
$type_message = '';

// Récupérer l'ID du produit à modifier depuis l'URL
$id_produit = intval($_GET['id'] ?? 0);
if ($id_produit === 0) {
    header('Location: gestion_produits.php');
    exit();
}

// Récupérer le produit existant
$stmt = $dbpdo->prepare("SELECT * FROM produits WHERE id_produit = :id");
$stmt->execute([':id' => $id_produit]);
$produit = $stmt->fetch();

if (!$produit) {
    header('Location: gestion_produits.php');
    exit();
}

// ACTION : ENREGISTRER LES MODIFICATIONS

if (isset($_POST['modifier_produit'])) {

    $nom         = trim($_POST['nom'] ?? '');
    $prix        = floatval($_POST['prix'] ?? 0);
    $categorie   = trim($_POST['categorie'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $stock       = intval($_POST['stock'] ?? 0);

    // Garder l'ancienne image par défaut
    $chemin_image = $produit['image'];

    // Si une nouvelle image a été envoyée, la traiter
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $extensions_autorisees = ['jpg', 'jpeg', 'png', 'webp', 'avif'];

        if (in_array($extension, $extensions_autorisees) && getimagesize($_FILES['image']['tmp_name'])) {
            $nouveau_nom    = uniqid('produit_') . '.' . $extension;
            $dossier_upload = '../../../frontend/images/uploads/';

            if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier_upload . $nouveau_nom)) {
                // Supprimer l'ancienne image si elle est dans uploads/
                if (strpos($produit['image'], 'uploads/') !== false) {
                    $ancienne = '../../../frontend/' . $produit['image'];
                    if (file_exists($ancienne)) unlink($ancienne);
                }
                $chemin_image = '../images/uploads/' . $nouveau_nom;
            }
        }
    }

    // Mettre à jour le produit dans la base de données
    $stmt = $dbpdo->prepare(
        "UPDATE produits SET nom = :nom, prix = :prix, image = :image,
         categorie = :cat, description = :desc, stock = :stock
         WHERE id_produit = :id"
    );
    $stmt->execute([
        ':nom'   => $nom,
        ':prix'  => $prix,
        ':image' => $chemin_image,
        ':cat'   => $categorie,
        ':desc'  => $description,
        ':stock' => $stock,
        ':id'    => $id_produit,
    ]);

    $message      = '✅ Produit modifié avec succès !';
    $type_message = 'succes';

    // Recharger les données du produit modifié
    $stmt = $dbpdo->prepare("SELECT * FROM produits WHERE id_produit = :id");
    $stmt->execute([':id' => $id_produit]);
    $produit = $stmt->fetch();
}

// Récupérer les catégories
$categories = $dbpdo->query("SELECT * FROM categorie ORDER BY nom")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora Admin - Modifier produit</title>
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="admin-body">

  <header class="admin-header">
    <div class="admin-header-gauche">
      <i class="fa-solid fa-shop"></i>
      <span>Velora <em>Admin</em></span>
    </div>
    <nav class="admin-nav">
      <a href="dashboard.php"><i class="fa-solid fa-gauge"></i> Tableau de bord</a>
      <a href="gestion_produits.php" class="actif"><i class="fa-solid fa-box"></i> Produits</a>
      <a href="gestion_categories.php"><i class="fa-solid fa-tags"></i> Catégories</a>
      <a href="gestion_commandes.php"><i class="fa-solid fa-cart-shopping"></i> Commandes</a>
      <a href="../../../backend/deconnexion.php" class="admin-deconnexion">
        <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
      </a>
    </nav>
  </header>

  <main class="admin-main">
    <h1><i class="fa-solid fa-pen"></i> Modifier le produit</h1>

    <?php if ($message): ?>
      <div class="admin-message admin-message-<?php echo $type_message; ?>">
        <?php echo htmlspecialchars($message); ?>
      </div>
    <?php endif; ?>

    <section class="admin-formulaire">
      <form method="POST" action="" enctype="multipart/form-data">

        <div class="form-grid">
          <div class="form-group">
            <label>Nom du produit *</label>
            <input type="text" name="nom" required value="<?php echo htmlspecialchars($produit['nom']); ?>">
          </div>
          <div class="form-group">
            <label>Prix (FCFA) *</label>
            <input type="number" name="prix" step="100" required value="<?php echo $produit['prix']; ?>">
          </div>
          <div class="form-group">
            <label>Catégorie *</label>
            <select name="categorie" required>
              <?php foreach ($categories as $cat): ?>
                <option
                  value="<?php echo htmlspecialchars($cat['nom']); ?>"
                  <?php echo ($cat['nom'] === $produit['categorie']) ? 'selected' : ''; ?>
                >
                  <?php echo htmlspecialchars($cat['nom']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" min="0" value="<?php echo $produit['stock']; ?>">
          </div>
          <div class="form-group form-group-large">
            <label>Description</label>
            <textarea name="description"><?php echo htmlspecialchars($produit['description'] ?? ''); ?></textarea>
          </div>
          <div class="form-group form-group-large">
            <label>Image actuelle</label>
            <img src="<?php echo htmlspecialchars($produit['image']); ?>" alt="Image actuelle"
                 style="max-width:150px;border-radius:8px;display:block;margin-bottom:10px;">
            <label>Nouvelle image (laisser vide pour garder l'actuelle)</label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,.avif">
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" name="modifier_produit" class="btn-admin btn-succes">
            <i class="fa-solid fa-save"></i> Enregistrer les modifications
          </button>
          <a href="gestion_produits.php" class="btn-admin">
            <i class="fa-solid fa-arrow-left"></i> Retour à la liste
          </a>
        </div>

      </form>
    </section>
  </main>

</body>
</html>