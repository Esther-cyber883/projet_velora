<?php
include '../../../backend/admin/verify_admin.php';

$message = '';

// === TRAITEMENT DU FORMULAIRE D'AJOUT DE PRODUIT ===
if (isset($_POST['ajouter_produit'])) {
    $nom         = trim($_POST['nom']);
    $prix        = floatval($_POST['prix']);
    $categorie   = trim($_POST['categorie']);
    $description = trim($_POST['description']);
    $stock       = intval($_POST['stock']);

    // === UPLOAD DE L'IMAGE ===
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $extensions_autorisees = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
        
        if (!in_array($extension, $extensions_autorisees)) {
            $message = "❌ Format d'image non autorisé. Utilisez : jpg, png, webp.";
        } else {
            // Créer un nom unique pour éviter les doublons
            $nouveau_nom = uniqid('produit_') . '.' . $extension;
            $dossier_upload = '../../images/uploads/';
            $chemin_image = $dossier_upload . $nouveau_nom;
            
            // Déplacer l'image dans le dossier uploads
            if (move_uploaded_file($_FILES['image']['tmp_name'], $chemin_image)) {
                // Chemin relatif pour la base de données
                $chemin_db = '../images/uploads/' . $nouveau_nom;
                
                // Insérer le produit dans la base de données
                $stmt = $dbpdo->prepare("INSERT INTO produits 
                    (nom, prix, image, categorie, description, stock) 
                    VALUES (:nom, :prix, :image, :categorie, :description, :stock)");
                $stmt->execute([
                    ':nom'         => $nom,
                    ':prix'        => $prix,
                    ':image'       => $chemin_db,
                    ':categorie'   => $categorie,
                    ':description' => $description,
                    ':stock'       => $stock,
                ]);
                $message = "✅ Produit ajouté avec succès !";
            } else {
                $message = "❌ Erreur lors de l'upload de l'image.";
            }
        }
    } else {
        $message = "❌ Veuillez sélectionner une image.";
    }
}

// === SUPPRESSION D'UN PRODUIT ===
if (isset($_GET['supprimer'])) {
    $id = intval($_GET['supprimer']);
    $stmt = $dbpdo->prepare("DELETE FROM produits WHERE id_produit = :id");
    $stmt->execute([':id' => $id]);
    $message = "✅ Produit supprimé.";
}

// === RÉCUPÉRER LA LISTE DES PRODUITS ===
$produits = $dbpdo->query("SELECT * FROM produits ORDER BY date_creation DESC")->fetchAll();

// === RÉCUPÉRER LES CATÉGORIES pour le formulaire ===
$categories = $dbpdo->query("SELECT * FROM categorie ORDER BY nom")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Velora - Gestion Produits</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="admin-header">
    <div class="admin-header-gauche">
        <i class="fa-solid fa-shop"></i>
        <span>Velora <em>Admin</em></span>
    </div>
    <nav class="admin-nav">
        <a href="dashboard.php">Tableau de bord</a>
        <a href="gestion_produit.php">Produits</a>
        <a href="gestion_categorie.php">Catégories</a>
        <a href="../afficher.php">Clients</a>
        <a href="/Velora/backend/deconnexion.php">Déconnexion</a>
    </nav>
</header>

    <main class="admin-main">
        <h2>Gestion des Produits</h2>

        <?php if ($message): ?>
            <p class="admin-message"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- FORMULAIRE D'AJOUT DE PRODUIT -->
        <section class="admin-formulaire">
            <h3>Ajouter un nouveau produit</h3>
            <!-- enctype="multipart/form-data" est OBLIGATOIRE pour l'upload de fichier -->
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nom du produit *</label>
                    <input type="text" name="nom" required>
                </div>
                <div class="form-group">
                    <label>Prix (FCFA) *</label>
                    <input type="number" name="prix" step="0.01" required>
                </div>
                <div class="form-group">
                    <label>Catégorie *</label>
                    <select name="categorie" required>
                        <option value="">-- Choisir --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat['nom']); ?>">
                                <?php echo htmlspecialchars($cat['nom']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description"></textarea>
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" name="stock" value="100" min="0">
                </div>
                <div class="form-group">
                    <label>Image du produit (jpg, png, webp) *</label>
                    <!-- C'est l'upload dont tu parlais — pas besoin de mettre le chemin manuellement -->
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,.avif" required>
                </div>
                <button type="submit" name="ajouter_produit" class="btn-admin">
                    <i class="fa-solid fa-plus"></i> Ajouter le produit
                </button>
            </form>
        </section>

        <!-- LISTE DES PRODUITS -->
        <section>
            <h3>Produits existants (<?php echo count($produits); ?>)</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $p): ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($p['image']); ?>" 
                                 alt="" style="width:60px;height:60px;object-fit:cover;"></td>
                        <td><?php echo htmlspecialchars($p['nom']); ?></td>
                        <td><?php echo number_format($p['prix'], 0, ',', ' '); ?> FCFA</td>
                        <td><?php echo htmlspecialchars($p['categorie']); ?></td>
                        <td><?php echo $p['stock']; ?></td>
                        <td>
                            <a href="modifier_produit.php?id=<?php echo $p['id_produit']; ?>" 
                               class="btn-admin btn-modifier">Modifier</a>
                            <a href="?supprimer=<?php echo $p['id_produit']; ?>" 
                               class="btn-admin btn-supprimer"
                               onclick="return confirm('Supprimer ce produit ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>