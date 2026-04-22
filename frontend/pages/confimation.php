<?php
// ============================================================
// confirmation.php — Page affichée après une commande réussie
// ============================================================
include '../../backend/db.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: connexion.php');
    exit();
}

// Récupérer l'ID de la commande depuis l'URL
$id_commande = intval($_GET['commande'] ?? 0);

if ($id_commande === 0) {
    header('Location: main.php');
    exit();
}

// Récupérer les détails de la commande
$stmt = $dbpdo->prepare(
    "SELECT * FROM commandes 
     WHERE id_commande = :id AND id_utilisateur = :uid"
);
$stmt->execute([':id' => $id_commande, ':uid' => $_SESSION['id_utilisateur']]);
$commande = $stmt->fetch();

// Vérifier que la commande appartient bien à cet utilisateur
if (!$commande) {
    header('Location: main.php');
    exit();
}

// Récupérer les détails des produits commandés
$stmt_details = $dbpdo->prepare(
    "SELECT * FROM details_commande WHERE id_commande = :id"
);
$stmt_details->execute([':id' => $id_commande]);
$details = $stmt_details->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora - Commande confirmée</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <?php include 'header_nav.php'; ?>

  <section class="confirmation-section">
    <!-- Icône de succès -->
    <div class="confirmation-icone">
      <i class="fa-solid fa-circle-check"></i>
    </div>

    <h1>Commande confirmée !</h1>
    <p>Merci <strong><?php echo htmlspecialchars($commande['nom_utilisateur']); ?></strong>,
       votre commande a bien été enregistrée.</p>

    <!-- Récapitulatif de la commande -->
    <div class="confirmation-recap">
      <h2>Récapitulatif de la commande #<?php echo $id_commande; ?></h2>

      <table class="confirmation-table">
        <thead>
          <tr>
            <th>Produit</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Sous-total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($details as $d): ?>
          <tr>
            <td><?php echo htmlspecialchars($d['nom_produit']); ?></td>
            <td><?php echo number_format($d['prix_unitaire'], 0, ',', ' '); ?> FCFA</td>
            <td><?php echo $d['quantite']; ?></td>
            <td><?php echo number_format($d['prix_unitaire'] * $d['quantite'], 0, ',', ' '); ?> FCFA</td>
          </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong><?php echo number_format($commande['montant_total'], 0, ',', ' '); ?> FCFA</strong></td>
          </tr>
        </tfoot>
      </table>

      <div class="confirmation-infos">
        <p><strong>Livraison à :</strong> <?php echo htmlspecialchars($commande['Adresse']); ?></p>
        <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($commande['telephone']); ?></p>
        <p><strong>Mode de paiement :</strong> <?php echo htmlspecialchars($commande['mode_paiement']); ?></p>
        <p><strong>Statut :</strong> <span class="statut-attente">En attente</span></p>
      </div>
    </div>

    <div class="confirmation-actions">
      <a href="boutique.php" class="bouton">Continuer mes achats</a>
      <a href="main.php" class="bouton bouton-blanc">Retour à l'accueil</a>
    </div>
  </section>

  <footer class="footer">
    <div class="footer-contenu">
      <div class="footer-colonne">
        <h3>Velora</h3>
        <p>Parfums, maquillage, soins, perruques et services beauté.</p>
      </div>
      <div class="footer-colonne">
        <h3>Contact</h3>
        <p>Email: estherkpeglo273@gmail.com</p>
        <p>Téléphone: 92 96 05 63</p>
      </div>
    </div>
    <p class="footer-copyright">Velora. Tous droits réservés.</p>
  </footer>

  <?php include 'footer_scripts.php'; ?>
</body>
</html>