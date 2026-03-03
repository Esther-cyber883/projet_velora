<?php
include '../../../backend/admin/verify_admin.php'; // Sécurité en premier
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Velora - Admin</title>
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
        <h2>Tableau de bord</h2>
        <?php
        // Compter les produits
        $nb_produits = $dbpdo->query("SELECT COUNT(*) FROM produits")->fetchColumn();
        // Compter les clients
        $nb_clients = $dbpdo->query("SELECT COUNT(*) FROM utilisateur")->fetchColumn();
        // Compter les commandes
        $nb_commandes = $dbpdo->query("SELECT COUNT(*) FROM commandes")->fetchColumn();
        ?>
        <div class="admin-stats">
            <div class="stat-card">
                <i class="fa-solid fa-box"></i>
                <span><?php echo $nb_produits; ?></span>
                <p>Produits</p>
            </div>
            <div class="stat-card">
                <i class="fa-solid fa-users"></i>
                <span><?php echo $nb_clients; ?></span>
                <p>Clients</p>
            </div>
            <div class="stat-card">
                <i class="fa-solid fa-cart-shopping"></i>
                <span><?php echo $nb_commandes; ?></span>
                <p>Commandes</p>
            </div>
        </div>
    </main>
</body>
</html>