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

  <header class="header">
    <div class="header-gauche">
      <i class="fa-solid fa-shop header-logo-icon" aria-hidden="true"></i>
      <span class="header-nom">Velora</span>
    </div>
    <nav class="header-nav" id="navMenu">
      <a href="main.php">Accueil</a>
      <a href="boutique.php">Boutique</a>
      <a href="inscription.php">Inscription</a>
    </nav>
    <div class="header-droite">
      <a href="panier.php" class="header-action header-panier" aria-label="Panier"><i class="fa-solid fa-cart-shopping" aria-hidden="true"></i></a>
      <div class="user-menu">
        <button class="user-avatar" id="userAvatar" aria-label="Menu utilisateur">
          <i class="fa-solid fa-user" aria-hidden="true"></i>
        </button>
        <div class="user-dropdown" id="userDropdown">
          <a href="connexion.php">Se connecter</a>
          <a href="#">Déconnexion</a>
          <a href="afficher.php">Afficher tous nos clients</a>
        </div>
      </div>
      <button class="menu-burger" id="menuBurger" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>

  <section class="page-hero page-hero-avec-image">
    <div class="page-hero-overlay" aria-hidden="true"></div>
    <h1 class="page-hero-titre">Tous nos clients</h1>
    <p class="page-hero-description">Gérer et consulter la liste complète de nos clients inscrits.</p>
  </section>

  <div class="afficher-contenu">
    <main class="clients-main">
      <?php
include '../../backend/db.php'; // db.php démarre déjà la session

// Vérifier que l'utilisateur est connecté ET qu'il est admin
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: connexion.php');
    exit();
}
?>
<?php
include '../../backend/db.php';

// recuperation des données du formulaire d'inscription
$requete = "SELECT id_utilisateur, nom, prenom, email, telephone, adresse, ville FROM utilisateur ORDER BY id_utilisateur ASC";
$resultat = $dbpdo->query($requete); //appliquer la methode query() pour exécuter la requete SQL et récupérer les résultats dans $resultat

if (!$resultat) {
    echo "Erreur lors de la récupération des données.";
} else {
    $nbre_utilisateurs = $resultat->rowCount(); //compter le nombre de lignes dans le résultat

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
  </script>

 <?php
$resultat->closeCursor(); //fermer le curseur pour libérer les ressources associées au résultat
?>

</body>
</html>