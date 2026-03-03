<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora - Paiement</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/panier-paiement.css">
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
      <a href="index.html">Accueil</a>
      <a href="boutique.html">Boutique</a>
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
  </header>

  <!-- 1ere section: même que boutique -->
  <section class="page-hero page-hero-avec-image">
    <div class="page-hero-overlay" aria-hidden="true"></div>
    <h1 class="page-hero-titre">Paiement</h1>
    <p class="page-hero-description">Finalisez votre commande en toute sécurité.</p>
  </section>

  <section class="paiement-section">
    <h2>Paiement</h2>

    <!-- Récapitulatif de la commande -->
    <div class="paiement-bloc">
      <h3>Récapitulatif de la commande</h3>
      <p>Nombre d'articles: 0</p>
      <p>Sous-total: 00,00</p>
      <p>Frais de livraison: 00,00</p>
      <p><strong>Total: 00,00</strong></p>
    </div>

    <!-- Adresse de livraison -->
    <div class="paiement-bloc">
      <h3>Adresse de livraison</h3>
      <form action="#" method="post">
        <div class="formulaire-groupe">
          <label for="adresse">Adresse</label>
          <input type="text" id="adresse" name="adresse" required>
        </div>
        <div class="formulaire-groupe">
          <label for="ville">Ville</label>
          <input type="text" id="ville" name="ville" required>
        </div>
        <div class="formulaire-groupe">
          <label for="codepostal">Code postal</label>
          <input type="text" id="codepostal" name="codepostal" required>
        </div>
        <div class="formulaire-groupe">
          <label for="pays">Pays</label>
          <input type="text" id="pays" name="pays" required>
        </div>
      </form>
    </div>

    <!-- Moyen de paiement -->
    <div class="paiement-bloc">
      <h3>Moyen de paiement</h3>
      <form action="#" method="post">
        <div class="formulaire-groupe">
          <label><input type="radio" name="paiement" value="carte"> Carte bancaire</label>
        </div>
        <div class="formulaire-groupe">
          <label><input type="radio" name="paiement" value="especes"> Paiement à la livraison (espèces)</label>
        </div>
        <div class="formulaire-groupe">
          <label for="numerocarte">Numéro de carte</label>
          <input type="text" id="numerocarte" name="numerocarte" placeholder="0000 0000 0000 0000" maxlength="19">
        </div>
        <div class="formulaire-groupe">
          <label for="dateexp">Date d'expiration</label>
          <input type="text" id="dateexp" name="dateexp" placeholder="MM/AA" maxlength="5">
        </div>
        <div class="formulaire-groupe">
          <label for="cvv">CVV</label>
          <input type="text" id="cvv" name="cvv" placeholder="000" maxlength="4">
        </div>
      </form>
    </div>

    <div class="paiement-bouton">
      <button type="submit" class="bouton">Confirmer le paiement</button>
    </div>
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
