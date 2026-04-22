<?php
include '../../backend/db.php'; // Connexion BDD + session_start()

// Rediriger si non connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: connexion.php');
    exit();
}

// Récupérer toutes les catégories depuis la table 'categorie'
$stmt_categories = $dbpdo->query("SELECT * FROM categorie ORDER BY nom");
$categories = $stmt_categories->fetchAll();

// Récupérer tous les produits, triés par catégorie puis par nom
$stmt_produits = $dbpdo->query("SELECT * FROM produits ORDER BY categorie, nom");
$tous_les_produits = $stmt_produits->fetchAll();

// Organiser les produits dans un tableau associatif : ['NomCategorie' => [produit1, produit2, ...]]
$produits_par_categorie = [];
foreach ($tous_les_produits as $produit) {
    $cat = $produit['categorie'] ?? 'Autres';
    $produits_par_categorie[$cat][] = $produit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora - Boutique</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/boutique.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>/* Avatar utilisateur et dropdown */
.user-menu {
  position: relative;
  display: flex;
  align-items: center;
}

.user-avatar {
  width: 44px;
  height: 44px;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, var(--couleur-rose-clair), var(--couleur-or));
  color: var(--couleur-blanc);
  border: none;
  border-radius: 50%;
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  box-shadow: 0 2px 8px rgba(201, 162, 39, 0.3);
  font-size: 1.2rem;
}

.user-avatar:hover {
  transform: scale(1.1);
  box-shadow: 0 4px 12px rgba(201, 162, 39, 0.5);
  color: var(--couleur-blanc);
}

.user-avatar:active {
  transform: scale(0.95);
}

.user-dropdown {
  position: absolute;
  top: 100%;
  right: 0;
  margin-top: 8px;
  background-color: var(--couleur-blanc);
  border: 1px solid rgba(201, 162, 39, 0.2);
  border-radius: 8px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
  min-width: 200px;
  opacity: 0;
  visibility: hidden;
  transform: translateY(-10px);
  transition: opacity 0.25s ease, visibility 0.25s ease, transform 0.25s ease;
  z-index: 1000;
  overflow: hidden;
}

.user-dropdown.active {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.user-dropdown a {
  display: block;
  padding: 12px 16px;
  color: var(--couleur-noir);
  text-decoration: none;
  font-size: 0.95rem;
  transition: background-color 0.15s ease, color 0.15s ease;
  border-bottom: 1px solid rgba(201, 162, 39, 0.1);
}

.user-dropdown a:last-child {
  border-bottom: none;
}

.user-dropdown a:hover {
  background-color: var(--couleur-rose-clair);
  color: var(--couleur-noir);
  padding-left: 20px;
}
.boutique-sidebar a {
  text-decoration: none;
  margin-top: 20px;
  font-size: 20px;
  color: white;
}
.boutique-sidebar{
  margin-top: 300px;
  height: 300px;

}
.boutique-sidebar ul li{
  margin-top: 50px;
}
</style>
<body>

  
  <?php include 'header_nav.php'; ?>

  <!-- ======== BANNIÈRE ======== -->
  <section class="page-hero page-hero-avec-image">
    <div class="page-hero-overlay" aria-hidden="true"></div>
    <h1 class="page-hero-titre">Boutique</h1>
    <p class="page-hero-description">
      Découvrez nos parfums, maquillages, soins et perruques.
    </p>
  </section>

  <!-- ======== CONTENU PRINCIPAL ======== -->
  <div class="boutique-contenu">

    <!-- === SIDEBAR : Liste des catégories === -->
    <aside class="boutique-sidebar">
      <h3>Catégories</h3>
      <ul>
        <?php if (empty($categories)): ?>
          <li>Aucune catégorie</li>
        <?php else: ?>
          <?php foreach ($categories as $cat): ?>
            <!-- Créer un lien ancre vers chaque section de catégorie -->
            <li>
              <a href="#cat-<?php echo htmlspecialchars(strtolower(str_replace(' ', '-', $cat['nom']))); ?>">
                <?php echo htmlspecialchars($cat['nom']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>
    </aside>

    <!-- === ZONE PRODUITS : générée dynamiquement === -->
    <main class="prod">

      <?php if (empty($produits_par_categorie)): ?>
        <!-- Message si aucun produit dans la base de données -->
        <div class="boutique-vide">
          <i class="fa-solid fa-box-open"></i>
          <p>Aucun produit disponible pour le moment.</p>
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="admin/gestion_produits.php" class="bouton">
              Ajouter des produits
            </a>
          <?php endif; ?>
        </div>

      <?php else: ?>
        <?php foreach ($produits_par_categorie as $nom_categorie => $produits): ?>

          <!-- Titre de la catégorie avec ancre pour la navigation sidebar -->
          <div class="section-title">
            <h2 id="cat-<?php echo htmlspecialchars(strtolower(str_replace(' ', '-', $nom_categorie))); ?>">
              <?php echo htmlspecialchars($nom_categorie); ?>
            </h2>
          </div>

          <!-- Grille des produits de cette catégorie -->
          <div class="produits-grille">
            <?php foreach ($produits as $produit): ?>
            <article class="produit-card">
              <a href="produit_detail.php?id=<?php echo $produit['id_produit']; ?>">
                <!-- Image venant de la base de données -->
                <img
                  src="<?php echo htmlspecialchars($produit['image']); ?>"
                  alt="<?php echo htmlspecialchars($produit['nom']); ?>"
                  loading="lazy"
                >
                <h3><?php echo htmlspecialchars($produit['nom']); ?></h3>
              </a>

              <!-- Description courte si elle existe -->
              <?php if (!empty($produit['description'])): ?>
                <p class="produit-description">
                  <?php echo htmlspecialchars($produit['description']); ?>
                </p>
              <?php endif; ?>

              <div class="produit-footer">
                <!-- Prix formaté avec séparateur de milliers -->
                <p class="prix">
                  <?php echo number_format($produit['prix'], 0, ',', ' '); ?> FCFA
                </p>

                <!-- Afficher le stock si faible -->
                <?php if ($produit['stock'] <= 5 && $produit['stock'] > 0): ?>
                  <p class="stock-alerte">Plus que <?php echo $produit['stock']; ?> en stock !</p>
                <?php elseif ($produit['stock'] == 0): ?>
                  <p class="stock-epuise">Rupture de stock</p>
                <?php endif; ?>

                <div class="produit-actions">
                  <?php if ($produit['stock'] > 0): ?>
                    <!-- Formulaire d'ajout au panier -->
                    <form method="POST" action="../../backend/db_panier.php" style="display:inline;">
                      <input type="hidden" name="action" value="ajouter">
                      <!-- On envoie l'id du produit pour le retrouver en base de données -->
                      <input type="hidden" name="produit_id" value="<?php echo $produit['id_produit']; ?>">
                      <button type="submit" class="btn-panier" aria-label="Ajouter au panier">
                        <i class="fas fa-shopping-cart"></i>
                      </button>
                    </form>
                  <?php else: ?>
                    <!-- Bouton désactivé si rupture de stock -->
                    <button class="btn-panier" disabled title="Rupture de stock">
                      <i class="fas fa-shopping-cart"></i>
                    </button>
                  <?php endif; ?>
                </div>
              </div>
            </article>
            <?php endforeach; ?>
          </div>

        <?php endforeach; ?>
      <?php endif; ?>

    </main>
  </div>

  <!-- ======== PIED DE PAGE ======== -->
  <footer class="footer">
    <div class="footer-contenu">
      <div class="footer-colonne">
        <h3>Velora</h3>
        <p>Parfums, maquillage, soins, perruques et services beauté.</p>
      </div>
      <div class="footer-colonne">
        <h3>Liens utiles</h3>
        <ul>
          <li><a href="main.php">Accueil</a></li>
          <li><a href="boutique.php">Boutique</a></li>
        </ul>
      </div>
      <div class="footer-colonne">
        <h3>Contact</h3>
        <p>Email: estherkpeglo273@gmail.com</p>
        <p>Téléphone: 92 96 05 63</p>
        <p>Adresse: ZOSSIME</p>
      </div>
      <div class="footer-colonne">
        <h3>Compte</h3>
        <ul>
          <li><a href="connexion.php">Connexion</a></li>
          <li><a href="inscription.php">Inscription</a></li>
          <li><a href="panier.php">Panier</a></li>
        </ul>
      </div>
    </div>
    <p class="footer-copyright">Velora. Tous droits réservés.</p>
  </footer>

  <!-- ======== SCRIPTS ======== -->
  <script>
    // --- Menu burger responsive ---
    const menuBurger = document.getElementById('menuBurger');
    const navMenu = document.getElementById('navMenu');
    if (menuBurger && navMenu) {
      menuBurger.addEventListener('click', function () {
        menuBurger.classList.toggle('active');
        navMenu.classList.toggle('active');
      });
      navMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function () {
          menuBurger.classList.remove('active');
          navMenu.classList.remove('active');
        });
      });
    }

    // --- Dropdown utilisateur ---
    document.getElementById('userAvatar').addEventListener('click', function (e) {
      e.stopPropagation();
      document.getElementById('userDropdown').classList.toggle('active');
    });
    document.addEventListener('click', function () {
      document.getElementById('userDropdown').classList.remove('active');
    });
    document.getElementById('userDropdown').addEventListener('click', function (e) {
      e.stopPropagation();
    });
  </script>

  <?php include 'footer_scripts.php'; ?>
</body>
</html>