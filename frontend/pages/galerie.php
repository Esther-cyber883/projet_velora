  <!-- Section formulaire de réservation --
<?php include '../../backend/db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora - Galerie</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/galerie.css">
  <link rel="stylesheet" href="../css/afficher.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

  <?php include 'header_nav.php'; ?>

  <section class="page-hero page-hero-avec-image">
    <div class="page-hero-overlay" aria-hidden="true"></div>
    <h1 class="page-hero-titre">Galerie</h1>
    <p class="page-hero-description">Découvrez nos réalisations par type de service.</p>
  </section>

  
  <div class="galerie-filtres">
    <button type="button" class="galerie-filtre actif" data-type="spa">Spa et relaxation</button>
    <button type="button" class="galerie-filtre" data-type="manicure">Pédicure et manucure</button>
    <button type="button" class="galerie-filtre" data-type="sourcils">Tatouage sourcils & faux-cils</button>
    <button type="button" class="galerie-filtre" data-type="visage">Soins visage et massage</button>
    <button type="button" class="galerie-filtre" data-type="maquillage">Maquillage et  pose perruques</button>
  </div>

  
  <div class="galerie-contenu">
    <div class="galerie-type visible" id="galerie-spa">
      <h3>Spa et relaxation</h3>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/soin_spa1.avif" alt="Spa 1"></div>
        <div class="galerie-card"><img src="../images/relaxation1.jpg" alt="Spa 2"></div>
        <div class="galerie-card"><img src="../images/massage.webp" alt="Spa 3"></div>
        <div class="galerie-card"><img src="../images/envelo.jpg" alt="Spa 4"></div>
      </div>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/soin_spa2.webp" alt="Spa 1"></div>
        <div class="galerie-card"><img src="../images/relaxation2.webp" alt="Spa 2"></div>
        <div class="galerie-card"><img src="../images/massage1.webp" alt="Spa 3"></div>
        <div class="galerie-card"><img src="../images/envelope.webp" alt="Spa 4"></div>
      </div>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/soin_spa3.webp" alt="Spa 1"></div>
        <div class="galerie-card"><img src="../images/relaxation3.jpg" alt="Spa 2"></div>
        <div class="galerie-card"><img src="../images/massage2.jpg" alt="Spa 3"></div>
        <div class="galerie-card"><img src="../images/enveloppement.avif" alt="Spa 4"></div>
      </div>
    </div>
    <div class="galerie-type" id="galerie-manicure">
      <h3>Pédicure et manucure</h3>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/manicure.jpg" alt="Manucure 1"></div>
        <div class="galerie-card"><img src="../images/pedicure.jpg" alt="Manucure 2"></div>
        <div class="galerie-card"><img src="../images/vernis.webp" alt="Manicure 3"></div>
        <div class="galerie-card"><img src="../images/soin_ongles.jpg" alt="Manicure 4"></div>
      </div>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/manicure1.jpg" alt="Manucure 1"></div>
        <div class="galerie-card"><img src="../images/pedicure.webp" alt="Manucure 2"></div>
        <div class="galerie-card"><img src="../images/vernis1.jpg" alt="Manicure 3"></div>
        <div class="galerie-card"><img src="../images/soins_ongles.jpg" alt="Manicure 4"></div>
      </div>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/manicure2.webp" alt="Manucure 1"></div>
        <div class="galerie-card"><img src="../images/pedicure1.jpg" alt="Manucure 2"></div>
        <div class="galerie-card"><img src="../images/vernis4.jpg" alt="Manicure 3"></div>
        <div class="galerie-card"><img src="../images/soin_ongles.webp" alt="Manicure 4"></div>
      </div>
    </div>

    
    <div class="galerie-type" id="galerie-sourcils">
      <h3>pose perruques et maquillage</h3>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/tatoum.jpg" alt="Sourcils 1"></div>
        <div class="galerie-card"><img src="../images/maquifauxcils.jpg" alt="Sourcils 2"></div>
        <div class="galerie-card"><img src="../images/maquilagee1.jpg" alt="Sourcils 3"></div>
        <div class="galerie-card"><img src="../images/cils1.avif" alt="Sourcils 3"></div>
      </div>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/tatoumicro.jpg" alt="Sourcils 1"></div>
        <div class="galerie-card"><img src="../images/maquifauxcils1.avif" alt="Sourcils 2"></div>
        <div class="galerie-card"><img src="../images/maquilagee3.jpg" alt="Sourcils 3"></div>
        <div class="galerie-card"><img src="../images/cils2.jpg" alt="Sourcils 3"></div>
      </div>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/tatou.jpg" alt="Sourcils 1"></div>
        <div class="galerie-card"><img src="../images/maquifauxcils4.jpg" alt="Sourcils 2"></div>
        <div class="galerie-card"><img src="../images/maquilagee2.jpg" alt="Sourcils 3"></div>
        <div class="galerie-card"><img src="../images/cils3.jpg" alt="Sourcils 3"></div>
      </div>
    </div>
    <div class="galerie-type" id="galerie-sourcils">
      <h3>Tatouage sourcils & faux-cils</h3>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/tatoum.jpg" alt="Sourcils 1"></div>
        <div class="galerie-card"><img src="../images/maquifauxcils.jpg" alt="Sourcils 2"></div>
        <div class="galerie-card"><img src="../images/maquilagee1.jpg" alt="Sourcils 3"></div>
        <div class="galerie-card"><img src="../images/cils1.avif" alt="Sourcils 3"></div>
      </div>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/tatoumicro.jpg" alt="Sourcils 1"></div>
        <div class="galerie-card"><img src="../images/maquifauxcils1.avif" alt="Sourcils 2"></div>
        <div class="galerie-card"><img src="../images/maquilagee3.jpg" alt="Sourcils 3"></div>
        <div class="galerie-card"><img src="../images/cils2.jpg" alt="Sourcils 3"></div>
      </div>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/tatou.jpg" alt="Sourcils 1"></div>
        <div class="galerie-card"><img src="../images/maquifauxcils4.jpg" alt="Sourcils 2"></div>
        <div class="galerie-card"><img src="../images/maquilagee2.jpg" alt="Sourcils 3"></div>
        <div class="galerie-card"><img src="../images/cils3.jpg" alt="Sourcils 3"></div>
      </div>
    </div>
    <div class="galerie-type" id="galerie-visage">
      <h3>Soins visage et massage</h3>
      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/soins_visage11.webp" alt="Visage 1"></div>
        <div class="galerie-card"><img src="../images/soins_corps1.webp" alt="Visage 2"></div>
        <div class="galerie-card"><img src="../images/soins_corps3.webp" alt="Visage 3"></div>
      </div>

      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/soins_corps2.webp" alt="Visage 1"></div>
        <div class="galerie-card"><img src="../images/soins_visage13.jpg" alt="Visage 2"></div>
        <div class="galerie-card"><img src="../images/hydratation2.webp" alt="Visage 3"></div>
      </div>

      <div class="galerie-cards">
        <div class="galerie-card"><img src="../images/soins_visage12.jpg" alt="Visage 1"></div>
        <div class="galerie-card"><img src="../images/hydratation1.png" alt="Visage 2"></div>
        <div class="galerie-card"><img src="../images/massagevi2.webp" alt="Visage 3"></div>
      </div>
    </div>
  </div>

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
    (function() {
      var filtres = document.querySelectorAll('.galerie-filtre');
      var types = document.querySelectorAll('.galerie-type');
      filtres.forEach(function(btn) {
        btn.addEventListener('click', function() {
          var type = this.getAttribute('data-type');
          filtres.forEach(function(b) { b.classList.remove('actif'); });
          this.classList.add('actif');
          types.forEach(function(bloc) {
            var id = bloc.getAttribute('id');
            if (id === 'galerie-' + type) {
              bloc.classList.add('visible');
            } else {
              bloc.classList.remove('visible');
            }
          });
        });
      });
    })();
  </script>

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
