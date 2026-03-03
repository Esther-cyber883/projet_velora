<?php
include '../../../backend/admin/verify_admin.php';

$message = '';

// Ajouter une catégorie
if (isset($_POST['ajouter_categorie'])) {
    $nom = trim($_POST['nom_categorie']);
    if (!empty($nom)) {
        try {
            $stmt = $dbpdo->prepare("INSERT INTO categorie (nom) VALUES (:nom)");
            $stmt->execute([':nom' => $nom]);
            $message = "✅ Catégorie '$nom' ajoutée !";
        } catch (PDOException $e) {
            $message = "❌ Cette catégorie existe déjà.";
        }
    }
}

// Supprimer une catégorie
if (isset($_GET['supprimer'])) {
    $id = intval($_GET['supprimer']);
    $stmt = $dbpdo->prepare("DELETE FROM categorie WHERE id_categorie = :id");
    $stmt->execute([':id' => $id]);
    $message = "✅ Catégorie supprimée.";
}

// Récupérer toutes les catégories
$categories = $dbpdo->query("SELECT * FROM categorie ORDER BY nom")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Velora - Catégories</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/admin.css">
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
        <h2>Gestion des Catégories</h2>

        <?php if ($message): ?>
            <p class="admin-message"><?php echo $message; ?></p>
        <?php endif; ?>

        <section class="admin-formulaire">
            <h3>Ajouter une catégorie</h3>
            <form method="POST">
                <div class="form-group">
                    <label>Nom de la catégorie</label>
                    <input type="text" name="nom_categorie" required 
                           placeholder="Ex: Parfums, Maquillage...">
                </div>
                <button type="submit" name="ajouter_categorie" class="btn-admin">
                    Ajouter
                </button>
            </form>
        </section>

        <section>
            <h3>Catégories existantes</h3>
            <table class="admin-table">
                <thead>
                    <tr><th>ID</th><th>Nom</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td><?php echo $cat['id_categorie']; ?></td>
                        <td><?php echo htmlspecialchars($cat['nom']); ?></td>
                        <td>
                            <a href="?supprimer=<?php echo $cat['id_categorie']; ?>"
                               class="btn-admin btn-supprimer"
                               onclick="return confirm('Supprimer cette catégorie ?')">
                               Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>