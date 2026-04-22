<?php
include '../../backend/db.php';
// Vérifier que l'utilisateur est connecté ET qu'il est admin
if (!isset($_SESSION['id_utilisateur'])) {
  header('Location: connexion.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora - Afficher les clients</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/afficher.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

  <?php include 'header_nav.php'; ?>

  <section class="page-hero page-hero-avec-image">
    <div class="page-hero-overlay" aria-hidden="true"></div>
    <h1 class="page-hero-titre">Tous nos clients</h1>
    <p class="page-hero-description">Gérer et consulter la liste complète de nos clients inscrits.</p>
  </section>

  <div class="afficher-contenu">
    <main class="clients-main">
        <?php
    // recuperation des données du formulaire d'inscription
    $requete = "SELECT id_utilisateur, nom, prenom, email, telephone, adresse, ville FROM utilisateur ORDER BY id_utilisateur ASC";
    $resultat = $dbpdo->query($requete);

    if (!$resultat) {
      echo "Erreur lors de la récupération des données.";
    } else {
      $nbre_utilisateurs = $resultat->rowCount();

      ?>
      <div class="section-title">
        <h2>Clients inscrits</h2>
        <p class="nombre-clients">Nombre d'utilisateurs : <span><?php echo $nbre_utilisateurs; ?></span></p>
      </div>

      <div class="tableau-wrapper">
        <table class="clients-tableau">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Email</th>
              <th>Téléphone</th>
              <th>Adresse</th>
              <th>Ville</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($ligne = $resultat->fetch(PDO::FETCH_NUM)) { //fetch() pour récupérer les lignes du résultat une par une et les afficher dans un tableau HTML et PDO::FETCH_NUM pour récupérer les données sous forme de tableau numérique (indexé par des nombres) plutôt que de tableau associatif (indexé par des noms de colonnes)
                echo "<tr>"; //afficher les données de chaque utilisateur dans une ligne du tableau HTML
                foreach ($ligne as $valeur) {
                    echo "<td>" . htmlspecialchars($valeur) . "</td>"; //afficher chaque valeur de la ligne dans une cellule du tableau HTML . Le htmlspecialchars() est important pour la sécurité (évite les injections HTML)
                }
                echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

    <?php
 }
 ?>
      <div class="actions-clients">
        <a href="inscription.php" class="btn-action btn-inserer"><i class="fa-solid fa-user-plus"></i> Ajouter un client</a>
      </div>
    </main>
  </div>

  <script>
    // Toggle du dropdown utilisateur
    document.getElementById('userAvatar').addEventListener('click', function(e) {
      e.stopPropagation();
      const dropdown = document.getElementById('userDropdown');
      dropdown.classList.toggle('active');
    });

    // Fermer le dropdown si on clique ailleurs
    document.addEventListener('click', function() {
      const dropdown = document.getElementById('userDropdown');
      dropdown.classList.remove('active');
    });

    // Empêcher la fermeture si on clique dans le dropdown
    document.getElementById('userDropdown').addEventListener('click', function(e) {
      e.stopPropagation();
    });
 
  <?php
$resultat->closeCursor(); //fermer le curseur pour libérer les ressources associées au résultat
?>

  <?php include 'footer_scripts.php'; ?>
</body>
</html>