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
  <title>Velora - Connexion</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/formulaires.css">
  <link rel="stylesheet" href="../css/afficher.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
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
    <h1 class="page-hero-titre">Connexion</h1>
    <p class="page-hero-description">Connectez-vous à votre compte Velora.</p>
  </section>


  <section class="formulaire-section formulaire-etroit">

   <?php
   $message = null;
   $message_type = null;
   
   if (isset($_POST['connexion'])) {
     if (!empty($_POST['email']) && !empty($_POST['mot_de_passe'])) {
       $email = trim($_POST['email']);
       $mot_de_passe = $_POST['mot_de_passe'];
       try {
         $stmt = $dbpdo->prepare("SELECT * FROM utilisateur WHERE email = :email LIMIT 1");
         $stmt->bindParam(':email', $email);
         $stmt->execute();
         $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
         if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
           $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
           $_SESSION['email']          = $utilisateur['email'];
           $_SESSION['nom']            = $utilisateur['nom'];
           $_SESSION['role']           = $utilisateur['role'];
           header('Location: main.php');
           exit();
         } else {
           $message = "Email ou mot de passe incorrect. Veuillez réessayer.";
           $message_type = "error";
         }
       } catch(PDOException $e) {
         $message = "Erreur de connexion à la base de données.";
         $message_type = "error";
       }
     } else {
       $message = "Veuillez remplir tous les champs du formulaire.";
       $message_type = "warning";
     }
   }
 ?>

    <!-- Afficher la boîte de notification -->
    <?php if($message !== null): ?>
      <div class="notification-box notification-<?php echo $message_type; ?>">
        <?php if($message_type == 'success'): ?>
          <i class="fa-solid fa-circle-check"></i>
        <?php elseif($message_type == 'error'): ?>
          <i class="fa-solid fa-circle-xmark"></i>
        <?php else: ?>
          <i class="fa-solid fa-triangle-exclamation"></i>
        <?php endif; ?>
        
        <div>
          <?php echo htmlspecialchars($message); ?>
          <?php if($message_type == 'success'): ?>
            <span class="loader"></span>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

    <h2>Formulaire de connexion</h2>
    <form action="" method="POST">
      <div class="formulaire-groupe">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required placeholder="Entrez votre email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
      </div>
      <div class="formulaire-groupe">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="mot_de_passe" required placeholder="Entrez le mot de passe">
      </div>
      <div class="formulaire-bouton">
        <button type="submit" class="bouton" name="connexion">Se connecter</button>
      </div>
      <p class="center">
        <a href="inscription.php" class="fl">Pas encore de compte ? S'inscrire</a>
      </p>
    </form>
  </section>


  <footer class="footer">
    <div class="footer-contenu">
      <div class="footer-colonne"><h3>Velora</h3><p>Parfums, maquillage, soins, perruques et services beauté.</p></div>
      <div class="footer-colonne"><h3>Liens utiles</h3><ul><li><a href="main.php">Accueil</a></li><li><a href="boutique.php">Boutique</a></li><li><a href="reservation.php">Réservation</a></li><li><a href="services.php">Services</a></li><li><a href="galerie.php">Galerie</a></li></ul></div>
      <div class="footer-colonne"><h3>Contact</h3><p>Email: estherkpeglo273@gmail.com</p><p>Téléphone: 92 96 05 63</p><p>Adresse: ZOSSIME</p></div>
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
</body>
</html>