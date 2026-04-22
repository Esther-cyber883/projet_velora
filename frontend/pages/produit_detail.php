<?php
include '../../backend/db.php';

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: connexion.php');
    exit();
}

$id_produit = intval($_GET['id'] ?? 0);
if ($id_produit === 0) {
    header('Location: boutique.php');
    exit();
}

$stmt = $dbpdo->prepare("SELECT * FROM produits WHERE id_produit = :id");
$stmt->execute([':id' => $id_produit]);
$produit = $stmt->fetch();

if (!$produit) {
    header('Location: boutique.php');
    exit();
}

$est_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora - <?php echo htmlspecialchars($produit['nom']); ?></title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/boutique.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    .detail-section {
      max-width: 1100px;
      margin: 40px auto;
      padding: 0 20px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 50px;
      align-items: start;
    }
    .detail-image {
      width: 100%;
      border-radius: 16px;
      object-fit: cover;
      max-height: 480px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    }
    .detail-infos {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }
    .detail-categorie {
      font-size: 0.85rem;
      color: #c07a9a;
      text-transform: uppercase;
      letter-spacing: 2px;
      font-weight: 600;
    }
    .detail-nom {
      font-size: 2rem;
      font-weight: 700;
      color: #2d2d2d;
      margin: 0;
    }
    .detail-prix {
      font-size: 1.6rem;
      color: #b5446e;
      font-weight: 700;
    }
    .detail-description {
      font-size: 1rem;
      color: #555;
      line-height: 1.8;
      border-top: 1px solid #f0e0e8;
      padding-top: 16px;
    }
    .detail-stock {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 0.95rem;
      padding: 8px 16px;
      border-radius: 20px;
      font-weight: 600;
    }
    .stock-ok {
      background: #e8f5e9;
      color: #2e7d32;
    }
    .stock-bas {
      background: #fff3e0;
      color: #e65100;
    }
    .stock-zero {
      background: #fce4ec;
      color: #c62828;
    }
    .detail-actions {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
      margin-top: 10px;
    }
    .btn-detail {
      padding: 13px 28px;
      border-radius: 30px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-detail:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .btn-panier-detail {
      background: #b5446e;
      color: white;
    }
    .btn-modifier-detail {
      background: #f4a028;
      color: white;
    }
    .btn-retour {
      background: #f5f5f5;
      color: #555;
    }
    .breadcrumb {
      max-width: 1100px;
      margin: 20px auto 0;
      padding: 0 20px;
      font-size: 0.9rem;
      color: #999;
    }
    .breadcrumb a {
      color: #b5446e;
      text-decoration: none;
    }
    .breadcrumb a:hover { text-decoration: underline; }
    @media (max-width: 768px) {
      .detail-section { grid-template-columns: 1fr; gap: 24px; }
      .detail-nom { font-size: 1.5rem; }
    }
  </style>
</head>
<body>

  <?php include 'header_nav.php'; ?>

  <!-- Breadcrumb -->
  <div class="breadcrumb">
    <a href="main.php">Accueil</a> &rsaquo;
    <a href="boutique.php">Boutique</a> &rsaquo;
    <a href="boutique.php"><?php echo htmlspecialchars($produit['categorie']); ?></a> &rsaquo;
    <?php echo htmlspecialchars($produit['nom']); ?>
  </div>

  <!-- Détail produit -->
  <section class="detail-section">

    <!-- Image -->
    <div>
      <img
        class="detail-image"
        src="<?php echo htmlspecialchars($produit['image']); ?>"
        alt="<?php echo htmlspecialchars($produit['nom']); ?>"
      >
    </div>

    <!-- Infos -->
    <div class="detail-infos">

      <span class="detail-categorie">
        <i class="fa-solid fa-tag"></i>
        <?php echo htmlspecialchars($produit['categorie']); ?>
      </span>

      <h1 class="detail-nom"><?php echo htmlspecialchars($produit['nom']); ?></h1>

      <p class="detail-prix">
        <?php echo number_format($produit['prix'], 0, ',', ' '); ?> FCFA
      </p>

      <!-- Stock -->
      <?php if ($produit['stock'] > 10): ?>
        <span class="detail-stock stock-ok">
          <i class="fa-solid fa-circle-check"></i> En stock (<?php echo $produit['stock']; ?> disponibles)
        </span>
      <?php elseif ($produit['stock'] > 0): ?>
        <span class="detail-stock stock-bas">
          <i class="fa-solid fa-triangle-exclamation"></i> Plus que <?php echo $produit['stock']; ?> en stock !
        </span>
      <?php else: ?>
        <span class="detail-stock stock-zero">
          <i class="fa-solid fa-circle-xmark"></i> Rupture de stock
        </span>
      <?php endif; ?>

      <!-- Description -->
      <?php if (!empty($produit['description'])): ?>
        <div class="detail-description">
          <strong>Description :</strong><br>
          <?php echo nl2br(htmlspecialchars($produit['description'])); ?>
        </div>
      <?php endif; ?>

      <!-- Boutons -->
      <div class="detail-actions">

        <a href="boutique.php" class="btn-detail btn-retour">
          <i class="fa-solid fa-arrow-left"></i> Retour
        </a>

        <?php if ($produit['stock'] > 0): ?>
          <form method="POST" action="../../backend/db_panier.php" style="display:inline;">
            <input type="hidden" name="action" value="ajouter">
            <input type="hidden" name="produit_id" value="<?php echo $produit['id_produit']; ?>">
            <button type="submit" class="btn-detail btn-panier-detail">
              <i class="fa-solid fa-cart-shopping"></i> Ajouter au panier
            </button>
          </form>
        <?php endif; ?>

        <?php if ($est_admin): ?>
          <a href="admin/modifier_produit.php?id=<?php echo $produit['id_produit']; ?>"
             class="btn-detail btn-modifier-detail">
            <i class="fa-solid fa-pen"></i> Modifier ce produit
          </a>
        <?php endif; ?>

      </div>

    </div>
  </section>

  <footer class="footer">
    <div class="footer-contenu">
      <div class="footer-colonne"><h3>Velora</h3><p>Parfums, maquillage, soins, perruques et services beauté.</p></div>
      <div class="footer-colonne"><h3>Contact</h3><p>Email: estherkpeglo273@gmail.com</p><p>Téléphone: 92 96 05 63</p></div>
      <div class="footer-colonne"><h3>Liens</h3><ul>
        <li><a href="boutique.php">Boutique</a></li>
        <li><a href="panier.php">Panier</a></li>
      </ul></div>
    </div>
    <p class="footer-copyright">Velora. Tous droits réservés.</p>
  </footer>

  <script>
    document.getElementById('userAvatar').addEventListener('click', e => {
      e.stopPropagation();
      document.getElementById('userDropdown').classList.toggle('active');
    });
    document.addEventListener('click', () => document.getElementById('userDropdown').classList.remove('active'));
    document.getElementById('userDropdown').addEventListener('click', e => e.stopPropagation());
    const menuBurger = document.getElementById('menuBurger');
    const navMenu = document.getElementById('navMenu');
    if (menuBurger && navMenu) {
      menuBurger.addEventListener('click', () => {
        menuBurger.classList.toggle('active');
        navMenu.classList.toggle('active');
      });
    }
  </script>

  <?php include 'footer_scripts.php'; ?>
</body>
</html>