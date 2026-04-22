<?php
include '../../backend/db.php';
if (isset($_SESSION['id_utilisateur'])) {
    header('Location: main.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora - Inscription</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/formulaires.css">
  <link rel="stylesheet" href="../css/afficher.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
   
  <?php include 'header_nav.php'; ?>

  <section class="page-hero page-hero-avec-image">
   <div class=""></div>
    <h1 class="page-hero-titre">Inscription</h1>
    <p class="page-hero-description">Créez votre compte Velora.</p>
  </section>
 
  <section class="formulaire-section ">
    <h2>Formulaire d'inscription</h2>
    <form action="../../backend/register.php" method="POST">
      <div class="formulaire-groupe">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
          </div>
         <div class="formulaire-groupe">
        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required>
      </div>
        <div class="formulaire-groupe">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
       <div class="formulaire-groupe">
      
        <label for="telephone">Téléphone:</label>
        <input type="tel" id="telephone" name="telephone">
      </div>
       <div class="formulaire-groupe">
    
        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="Adresse" required>
      </div>
       <div class="formulaire-groupe">
      
        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville" required>
      </div>
       <div class="formulaire-groupe">
    
        <label for="motdepasse">Mot de passe:</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
      </div>
       <div class="formulaire-groupe">
      </div>
      <div class="formulaire-bouton">
        <button type="submit" class="bouton" name="envoyer">S'inscrire</button>
      
        <button type="reset" class="bouton" name="effacer">Effacer</button>
        
      </div>
      
      <p class="center">
        <a href="connexion.php" class="fl">Déjà un compte ? Se connecter</a>
      </p>
    </form>
  </section>

  <footer class="footer">
    <div class="footer-contenu">
      <div class="footer-colonne"><h3>Velora</h3><p>Parfums, maquillage, soins, perruques et services beauté.</p></div>
      <div class="footer-colonne"><h3>Liens utiles</h3><ul><li><a href="main.php">Accueil</a></li><li><a href="boutique.php">Boutique</a></li><li><a href="reservation.php">Réservation</a></li><li><a href="services.php">Services</a></li><li><a href="galerie.php">Galerie</a></li></ul></div>
      <div class="footer-colonne"><h3>Contact</h3><p>Email: estherkpeglo273@gmail.com</p><p>Téléphone:92 96 05 63</p><p>Adresse: ZOSSIME</p></div>
      <div class="footer-colonne"><h3>Compte</h3><ul><li><a href="connexion.php">Connexion</a></li><li><a href="inscription.php">Inscription</a></li><li><a href="panier.php">Panier</a></li></ul></div>
    </div>
    <p class="footer-copyright">Velora. Tous droits réservés.</p>
  </footer>

  <script>
    // Menu burger responsive
    const menuBurger = document.getElementById('menuBurger');
    const navMenu = document.getElementById('navMenu');
    
    if (menuBurger && navMenu) {
      menuBurger.addEventListener('click', function() {
        menuBurger.classList.toggle('active');
        navMenu.classList.toggle('active');
      });
      
      // Fermer le menu quand on clique sur un lien
      const navLinks = navMenu.querySelectorAll('a');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          menuBurger.classList.remove('active');
          navMenu.classList.remove('active');
        });
      });
    }
  </script>

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

  <?php include 'footer_scripts.php'; ?>
</body>
</html>
