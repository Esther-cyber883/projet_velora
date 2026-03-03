<?php

include 'db.php'; // Connexion BDD + session_start()

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: ../frontend/pages/connexion.php?message=connexion_requise');
    exit();
}

// Vérifier que le formulaire a bien été soumis en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../frontend/pages/panier.php');
    exit();
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Récupérer et nettoyer les données du formulaire
$nom_utilisateur = trim($_POST['nom'] ?? '');
$telephone       = trim($_POST['telephone'] ?? '');
$adresse         = trim($_POST['adresse'] ?? '');
$mode_paiement   = trim($_POST['mode_paiement'] ?? '');

// Vérifier que tous les champs sont remplis
if (empty($nom_utilisateur) || empty($telephone) || empty($adresse) || empty($mode_paiement)) {
    header('Location: ../frontend/pages/panier.php?erreur=champs_manquants');
    exit();
}

// Récupérer les articles du panier de cet utilisateur (jointure avec produits)
$stmt = $dbpdo->prepare(
    "SELECT p.id_panier, p.quantite, pr.id_produit, pr.nom, pr.prix, pr.stock
     FROM panier p
     JOIN produits pr ON p.id_produit = pr.id_produit
     WHERE p.id_utilisateur = :uid"
);
$stmt->execute([':uid' => $id_utilisateur]);
$items_panier = $stmt->fetchAll();

// Si le panier est vide, refuser la commande
if (empty($items_panier)) {
    header('Location: ../frontend/pages/panier.php?erreur=panier_vide');
    exit();
}

// Calculer le montant total
$montant_total = 0;
foreach ($items_panier as $item) {
    $montant_total += $item['prix'] * $item['quantite'];
}

// ============================================================
// Insérer la commande dans la table 'commandes' (transaction)
// Une transaction garantit que tout est enregistré ou rien
// ============================================================
try {
    $dbpdo->beginTransaction(); // Démarrer la transaction

    // 1. Insérer la commande principale
    $stmt_commande = $dbpdo->prepare(
        "INSERT INTO commandes (id_utilisateur, nom_utilisateur, telephone, Adresse, mode_paiement, montant_total, statut)
         VALUES (:uid, :nom, :tel, :adresse, :mode, :montant, 'en_attente')"
    );
    $stmt_commande->execute([
        ':uid'     => $id_utilisateur,
        ':nom'     => $nom_utilisateur,
        ':tel'     => $telephone,
        ':adresse' => $adresse,
        ':mode'    => $mode_paiement,
        ':montant' => $montant_total,
    ]);

    // Récupérer l'ID de la commande qui vient d'être créée
    $id_commande = $dbpdo->lastInsertId();

    // 2. Insérer chaque article dans la table 'details_commande'
    $stmt_detail = $dbpdo->prepare(
        "INSERT INTO details_commande (id_commande, id_produit, nom_produit, prix_unitaire, quantite)
         VALUES (:id_commande, :id_produit, :nom_produit, :prix, :quantite)"
    );

    foreach ($items_panier as $item) {
        $stmt_detail->execute([
            ':id_commande' => $id_commande,
            ':id_produit'  => $item['id_produit'],
            ':nom_produit' => $item['nom'],
            ':prix'        => $item['prix'],
            ':quantite'    => $item['quantite'],
        ]);

        // 3. Diminuer le stock du produit commandé
        $stmt_stock = $dbpdo->prepare(
            "UPDATE produits SET stock = stock - :qte WHERE id_produit = :id AND stock >= :qte"
        );
        $stmt_stock->execute([
            ':qte' => $item['quantite'],
            ':id'  => $item['id_produit'],
        ]);
    }

    // 4. Vider le panier après commande réussie
    $stmt_vider = $dbpdo->prepare("DELETE FROM panier WHERE id_utilisateur = :uid");
    $stmt_vider->execute([':uid' => $id_utilisateur]);

    // Valider toutes les opérations
    $dbpdo->commit();

    // Rediriger vers une page de confirmation
    header("Location: ../frontend/pages/confimation.php?commande=$id_commande");
    exit();

} catch (PDOException $e) {
    // En cas d'erreur, annuler toutes les opérations (rien n'est enregistré)
    $dbpdo->rollBack();
    header('Location: ../frontend/pages/panier.php?erreur=commande_echouee');
    exit();
}
?>