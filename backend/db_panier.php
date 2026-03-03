<?php
include 'db.php'; // Connexion BDD + session_start()

// Vérifier que l'utilisateur est connecté avant toute action
if (!isset($_SESSION['id_utilisateur'])) {
    // Rediriger vers la connexion avec un message
    header('Location: ../frontend/pages/connexion.php?message=connexion_requise');
    exit();
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Récupérer l'action demandée (depuis POST ou GET)
$action = $_POST['action'] ?? $_GET['action'] ?? '';

// ============================================================
// ACTION : AJOUTER UN PRODUIT AU PANIER
// ============================================================
if ($action === 'ajouter' && isset($_POST['produit_id'])) {

    $id_produit = intval($_POST['produit_id']); // intval() protège contre les injections

    // Vérifier que le produit existe et est en stock
    $stmt = $dbpdo->prepare("SELECT id_produit, stock FROM produits WHERE id_produit = :id");
    $stmt->execute([':id' => $id_produit]);
    $produit = $stmt->fetch();

    if (!$produit) {
        // Produit introuvable
        header('Location: ../frontend/pages/boutique.php?erreur=produit_introuvable');
        exit();
    }

    if ($produit['stock'] <= 0) {
        // Rupture de stock
        header('Location: ../frontend/pages/boutique.php?erreur=rupture_stock');
        exit();
    }

    // Vérifier si ce produit est déjà dans le panier de cet utilisateur
    $stmt = $dbpdo->prepare(
        "SELECT id_panier, quantite FROM panier 
         WHERE id_utilisateur = :uid AND id_produit = :pid"
    );
    $stmt->execute([':uid' => $id_utilisateur, ':pid' => $id_produit]);
    $existant = $stmt->fetch();

    if ($existant) {
        // Le produit est déjà dans le panier → augmenter la quantité de 1
        $update = $dbpdo->prepare(
            "UPDATE panier SET quantite = quantite + 1 
             WHERE id_panier = :id AND id_utilisateur = :uid"
        );
        $update->execute([':id' => $existant['id_panier'], ':uid' => $id_utilisateur]);
    } else {
        // Nouveau produit → l'insérer dans le panier
        $insert = $dbpdo->prepare(
            "INSERT INTO panier (id_utilisateur, id_produit, quantite) 
             VALUES (:uid, :pid, 1)"
        );
        $insert->execute([':uid' => $id_utilisateur, ':pid' => $id_produit]);
    }

    // Retourner sur la page panier après ajout
    header('Location: ../frontend/pages/panier.php?message=produit_ajoute');
    exit();
}

// ============================================================
// ACTION : SUPPRIMER UN ARTICLE DU PANIER
// ============================================================
if ($action === 'supprimer' && isset($_GET['id'])) {

    $id_panier = intval($_GET['id']);

    // Supprimer uniquement si cet article appartient bien à cet utilisateur (sécurité)
    $stmt = $dbpdo->prepare(
        "DELETE FROM panier WHERE id_panier = :id AND id_utilisateur = :uid"
    );
    $stmt->execute([':id' => $id_panier, ':uid' => $id_utilisateur]);

    header('Location: ../frontend/pages/panier.php');
    exit();
}

// ============================================================
// ACTION : VIDER TOUT LE PANIER
// ============================================================
if ($action === 'vider') {

    $stmt = $dbpdo->prepare("DELETE FROM panier WHERE id_utilisateur = :uid");
    $stmt->execute([':uid' => $id_utilisateur]);

    header('Location: ../frontend/pages/panier.php');
    exit();
}

// ============================================================
// ACTION : MODIFIER LA QUANTITÉ D'UN ARTICLE
// ============================================================
if ($action === 'maj_quantite' && isset($_POST['panier_id'], $_POST['quantite'])) {

    $id_panier = intval($_POST['panier_id']);
    $quantite  = intval($_POST['quantite']);

    if ($quantite <= 0) {
        // Si quantité = 0 ou négative → supprimer l'article
        $stmt = $dbpdo->prepare(
            "DELETE FROM panier WHERE id_panier = :id AND id_utilisateur = :uid"
        );
        $stmt->execute([':id' => $id_panier, ':uid' => $id_utilisateur]);
    } else {
        // Mettre à jour la quantité
        $stmt = $dbpdo->prepare(
            "UPDATE panier SET quantite = :qte 
             WHERE id_panier = :id AND id_utilisateur = :uid"
        );
        $stmt->execute([':qte' => $quantite, ':id' => $id_panier, ':uid' => $id_utilisateur]);
    }

    header('Location: ../frontend/pages/panier.php');
    exit();
}

// Si aucune action reconnue, retourner à la boutique
header('Location: ../frontend/pages/boutique.php');
exit();
?>