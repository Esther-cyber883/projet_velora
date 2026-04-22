<?php
// ============================================================
// main.php — Page d'accueil
// Redirige vers connexion.php si l'utilisateur n'est pas connecté
// ============================================================
include '../../backend/db.php';

// Rediriger vers la connexion si non connecté
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
  <title>Velora - Accueil</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/accueil.css">
  <link rel="stylesheet" href="../css/afficher.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

  <?php include 'header_nav.php'; ?>

  <!-- Slider -->
  <section class="slider-section">
    <div class="slider-piste">
      <div class="slider-slide slider-slide-1">
        <div class="slider-contenu">
          <p>Bienvenue chez Velora. Parfums, maquillage et soins pour sublimer votre quotidien.</p>
          <a href="boutique.php" class="bouton">Explorer</a>
        </div>
      </div>
      <div class="slider-slide slider-slide-2">
        <div class="slider-contenu">
          <p>Découvrez nos services spa, manucure et soins du visage.</p>
          <a href="boutique.php" class="bouton bouton-blanc">Découvrir</a>
        </div>
      </div>
      <div class="slider-slide slider-slide-3">
        <div class="slider-contenu">
          <p>Nos nouveautés et les marques partenaires qui nous font confiance.</p>
          <a href="boutique.php" class="bouton">Voir</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Marques -->
  <section class="marques-section">
    <h2>Nos marques partenaires</h2>
    <div class="marques-liste">
      <span>DIOR</span>
      <span>OUTRE</span>
      <span>MAC</span>
      <span>AVENE</span>
    </div>
  </section>

  <!-- Catégories — liens corrigés vers boutique.php -->
  <section class="categories-section">
    <h2>Catégories</h2>
    <div class="categories-grille">
      <a href="boutique.php" class="categorie-card">
        <img src="../images/parrf.webp" alt="Parfums">
        <span>Parfums</span>
      </a>
      <a href="boutique.php" class="categorie-card">
        <img src="../images/maqq.jpg" alt="Maquillage">
        <span>Maquillage</span>
      </a>
      <a href="boutique.php" class="categorie-card">
        <img src="../images/soiiin.webp" alt="Soins">
        <span>Soins</span>
      </a>
      <a href="boutique.php" class="categorie-card">
        <img src="../images/peer.jpg" alt="Perruques">
        <span>Perruques</span>
      </a>
    </div>
  </section>

  <!-- Nouveautés -->
  <section class="nouveautes-section">
    <h2>Nouveautés</h2>
    <div class="nouveautes-grille">
      <div class="nouveaute-card">
        <img src="../images/perruquenou.webp" alt="Perruque Naturelle">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Perruque Naturelle</h3>
          <p class="desc">Perruque naturelle, coupe longue et soyeuse.</p>
          <p class="prix">45 000 Francs</p>
          <a href="boutique.php" class="btn-paniere" aria-label="Voir dans la boutique"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/frontale.webp" alt="Frontale">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Frontale</h3>
          <p class="desc">Entretien simplifié, look moderne.</p>
          <p class="prix">12 000 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/eau_de_parfum_santal.jpg" alt="Eau de Parfum Santal">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Eau de Parfum Santal</h3>
          <p class="desc">Eau de parfum 50ml, notes florales délicates.</p>
          <p class="prix">25 000 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/club_de_nuit.jpg" alt="Club de Nuit">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Club de Nuit</h3>
          <p class="desc">Club de Nuit, longue tenue 100ml.</p>
          <p class="prix">40 000 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/dark_spot.jpg" alt="Dark Spot">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Dark Spot</h3>
          <p class="desc">Anti-tache &amp; nourrie.</p>
          <p class="prix">8 500 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/anti-age.jpg" alt="Crème Visage Anti-Âge">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Crème Visage Anti-Âge</h3>
          <p class="desc">Hydratation &amp; éclat - 50ml.</p>
          <p class="prix">15 000 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/visage_iluminant.webp" alt="Soin Visage Illuminant">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Soin Visage Illuminant</h3>
          <p class="desc">Concentré d'éclat pour un teint lumineux.</p>
          <p class="prix">20 000 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/rouge a levres 24h.webp" alt="Rouge à Lèvres 24h">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Rouge à Lèvres 24h</h3>
          <p class="desc">Hydratation intense, format voyage.</p>
          <p class="prix">3 500 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/font_de_teint_naturel.jpg" alt="Fond de Teint Naturel">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Fond de Teint Naturel</h3>
          <p class="desc">Finition légère et couvrante - 30ml.</p>
          <p class="prix">10 000 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/pallete des yeux.webp" alt="Palette Yeux">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Palette Yeux</h3>
          <p class="desc">Couleurs mat &amp; irisé.</p>
          <p class="prix">12 500 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/mascara_volume.webp" alt="Mascara Volume">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Mascara Volume</h3>
          <p class="desc">Cils volumineux et définition longue durée.</p>
          <p class="prix">6 000 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
      <div class="nouveaute-card">
        <img src="../images/spray.webp" alt="Spray Fixateur">
        <div class="nouveaute-details"><div class="nouveaute-text">
          <h3>Spray Fixateur</h3>
          <p class="desc">Fixation longue durée pour un maquillage parfait.</p>
          <p class="prix">4 500 Francs</p>
          <a href="boutique.php" class="btn-paniere"><i class="fas fa-shopping-cart"></i></a>
        </div></div>
      </div>
    </div>
  </section>

  <!-- À propos -->
  <section id="Apropos">
    <h1><em>À propos de nous</em></h1>
    <em>
      <p>Velora est une boutique en ligne spécialisée dans la vente de produits cosmétiques de qualité : parfums, maquillage, soins, et perruques. Nous sommes passionnés par la beauté et nous mettons tout en œuvre pour vous offrir les meilleures marques et les meilleurs produits.</p>
      <p>Notre équipe est à votre écoute pour répondre à toutes vos questions et vous aider à trouver le produit qui vous convient le mieux.</p>
    </em>
  </section>

  <footer class="footer">
    <div class="footer-contenu">
      <div class="footer-colonne"><h3>Velora</h3><p>Parfums, maquillage, soins, perruques et services beauté.</p></div>
      <div class="footer-colonne"><h3>Liens utiles</h3><ul><li><a href="main.php">Accueil</a></li><li><a href="boutique.php">Boutique</a></li></ul></div>
      <div class="footer-colonne"><h3>Contact</h3><p>Email: estherkpeglo273@gmail.com</p><p>Téléphone: 92 96 05 63</p><p>Adresse: ZOSSIME</p></div>
      <div class="footer-colonne"><h3>Compte</h3><ul>
        <li><a href="panier.php">Panier</a></li>
        <li><a href="../../backend/deconnexion.php">Déconnexion</a></li>
      </ul></div>
    </div>
    <p class="footer-copyright">Velora. Tous droits réservés.</p>
  </footer>

  <script>
    const menuBurger = document.getElementById('menuBurger');
    const navMenu    = document.getElementById('navMenu');
    if (menuBurger && navMenu) {
      menuBurger.addEventListener('click', () => {
        menuBurger.classList.toggle('active');
        navMenu.classList.toggle('active');
      });
      navMenu.querySelectorAll('a').forEach(l => l.addEventListener('click', () => {
        menuBurger.classList.remove('active');
        navMenu.classList.remove('active');
      }));
    }
    document.getElementById('userAvatar').addEventListener('click', function(e) {
      e.stopPropagation();
      document.getElementById('userDropdown').classList.toggle('active');
    });
    document.addEventListener('click', () => document.getElementById('userDropdown').classList.remove('active'));
    document.getElementById('userDropdown').addEventListener('click', e => e.stopPropagation());
  </script>

  <?php include 'footer_scripts.php'; ?>
</body>
</html>