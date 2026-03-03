  <!-- Section formulaire de réservation 
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora - Réservation</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/formulaires.css">
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
      <a href="index.html">Accueil</a>
      <a href="boutique.html">Boutique</a>
      <a href="reservation.html">Réservation</a>
      <a href="services.html">Services</a>
      <a href="galerie.html">Galerie</a>
      <a href="inscription.html">Inscription</a>
    </nav>
    <div class="header-droite">
      <a href="panier.html" class="header-action header-panier" aria-label="Panier"><i class="fa-solid fa-cart-shopping" aria-hidden="true"></i></a>
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
    <h1 class="page-hero-titre">Réservation</h1>
    <p class="page-hero-description">Réservez votre créneau pour nos services spa, manucure, soins du visage et plus.</p>
  </section>

  <!-- Section formulaire de réservation --
  <section class="formulaire-section">
    <h2>Formulaire de réservation</h2>
    <form action="#" method="post">
      <div class="formulaire-groupe">
        <label for="nom">Nom complet</label>
        <input type="text" id="nom" name="nom" required>
      </div>
      <div class="formulaire-groupe">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="formulaire-groupe">
        <label for="telephone">Téléphone</label>
        <input type="tel" id="telephone" name="telephone" required>
      </div>
      <div class="formulaire-groupe">
        <label for="service">Service souhaité</label>
        <select id="service" name="service" required>
          <option value="">Choisir un service</option>
          <option value="spa">Spa et relaxation</option>
          <option value="pedicure-manicure">Pédicure et manucure</option>
          <option value="tatouage-sourcils">Tatouage sourcils et maquillage visage</option>
          <option value="soins-visage">Soins du visage et massage</option>
        </select>
      </div>
      <div class="formulaire-groupe">
        <label for="date">Date souhaitée</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="formulaire-groupe">
        <label for="heure">Heure souhaitée</label>
        <input type="time" id="heure" name="heure" required>
      </div>
      <div class="formulaire-groupe">
        <label for="message">Message (optionnel)</label>
        <textarea id="message" name="message" placeholder="Précisions ou demandes particulières"></textarea>
      </div>
      <div class="formulaire-bouton">
        <button type="submit" class="bouton">Envoyer la réservation</button>
      </div>
    </form>
  </section>

  <footer class="footer">
    <div class="footer-contenu">
      <div class="footer-colonne"><h3>Velora</h3><p>Parfums, maquillage, soins, perruques et services beauté.</p></div>
      <div class="footer-colonne"><h3>Liens utiles</h3><ul><li><a href="index.html">Accueil</a></li><li><a href="boutique.html">Boutique</a></li><li><a href="reservation.html">Réservation</a></li><li><a href="services.html">Services</a></li><li><a href="galerie.html">Galerie</a></li></ul></div>
      <div class="footer-colonne"><h3>Contact</h3><p>Email: estherkpeglo273@gmail.com</p><p>Téléphone:92 96 05 63</p><p>Adresse: ZOSSIME</p></div>
      <div class="footer-colonne"><h3>Compte</h3><ul><li><a href="connexion.html">Connexion</a></li><li><a href="inscription.html">Inscription</a></li><li><a href="panier.html">Panier</a></li></ul></div>
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
