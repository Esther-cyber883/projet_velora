<?php
include '../../backend/db.php'; // Démarre la session
// Récupérer les articles du panier si l'utilisateur est connecté
$items_panier = [];
$total = 0;

if (!isset($_SESSION['id_utilisateur'])) { header('Location: connexion.php'); exit(); }
    $id_utilisateur = $_SESSION['id_utilisateur'];
    
    // Récupérer le panier avec les infos des produits (jointure)
    $stmt = $dbpdo->prepare("
        SELECT p.id_panier, pr.nom, pr.prix, pr.image, p.quantite
        FROM panier p
        JOIN produits pr ON p.id_produit = pr.id_produit
        WHERE p.id_utilisateur = :uid
    ");
    $stmt->execute([':uid' => $id_utilisateur]);
    $items_panier = $stmt->fetchAll();
    
    // Calculer le total
    foreach ($items_panier as $item) {
        $total += $item['prix'] * $item['quantite'];
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora - Panier & Paiement</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/panier-paiement.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
 
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
</style>
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
      <a href="panier.php" class="header-action header-panier" aria-label="Panier">
        <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
      </a>
      <div class="user-menu">
        <button class="user-avatar" id="userAvatar" aria-label="Menu utilisateur">
          <i class="fa-solid fa-user" aria-hidden="true"></i>
        </button>
        <div class="user-dropdown" id="userDropdown">
          <?php if (isset($_SESSION['id_utilisateur'])): ?>
            <span class="user-nom">Bonjour, <?php echo htmlspecialchars($_SESSION['nom']); ?></span>
            <?php if ($_SESSION['role'] === 'admin'): ?>
              <a href="admin/dashboard.php"><i class="fa-solid fa-gear"></i> Espace Admin</a>
            <?php endif; ?>
            <a href="../../backend/deconnexion.php"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
          <?php else: ?>
            <a href="connexion.php">Se connecter</a>
          <?php endif; ?>
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
    <h1 class="page-hero-titre">Panier & Paiement</h1>
    <p class="page-hero-description">Finalisez votre commande Velora.</p>
  </section>

  <section class="panier-section">
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-error">
        <?php
        if ($_GET['error'] === 'panier_vide') {
          echo "Votre panier est vide. Veuillez ajouter des produits avant de commander.";
        } elseif ($_GET['error'] === 'commande_echouee') {
          echo "Une erreur est survenue lors de la commande. Veuillez réessayer.";
        }
        ?>
      </div>
    <?php endif; ?>

    <h2>Contenu du panier</h2>

    <?php if (empty($items_panier)): ?>
      <div class="panier-vide">
        <i class="fa-solid fa-cart-shopping"></i>
        <h3>Votre panier est vide</h3>
        <p>Découvrez nos produits et ajoutez-les à votre panier.</p>
        <a href="boutique.php" class="bouton">Découvrir la boutique</a>
      </div>
    <?php else: ?>
      
      <!-- Liste des produits dans le panier -->
      <?php foreach ($items_panier as $item): ?>
      <div class="panier-ligne">
        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['nom']); ?>">
        <div class="panier-ligne-details">
          <h3><?php echo htmlspecialchars($item['nom']); ?></h3>
          <p class="panier-ligne-prix">Prix unitaire: <?php echo number_format($item['prix'], 0, ',', ' '); ?> FCFA</p>
        </div>
        <div class="panier-ligne-quantite">
          <form method="POST" action="../../backend/db_panier.php" style="display: inline;">
            <input type="hidden" name="action" value="maj_quantite">
            <input type="hidden" name="panier_id" value="<?php echo $item['id_panier']; ?>">
            <label for="qte<?php echo $item['id_panier']; ?>">Quantité</label>
            <input type="number" id="qte<?php echo $item['id_panier']; ?>" name="quantite" 
                   value="<?php echo $item['quantite']; ?>" min="1" max="99" 
                   onchange="this.form.submit()">
          </form>
        </div>
        <div class="panier-ligne-details">
          <p class="panier-ligne-prix">Sous-total: <?php echo number_format($item['prix'] * $item['quantite'], 0, ',', ' '); ?> FCFA</p>
        </div>
        <div>
          <a href="../../backend/db_panier.php?action=supprimer&id=<?php echo $item['id_panier']; ?>" 
             class="del" onclick="return confirm('Supprimer cet article ?')">Supprimer</a>
        </div>
      </div>
      <?php endforeach; ?>

      <!-- Total du panier -->
      <div class="panier-total">
        <p>Total à payer: <span><?php echo number_format($total, 0, ',', ' '); ?> FCFA</span></p>
      </div>

      <!-- Boutons actions -->
      <div class="panier-boutons">
        <a href="boutique.php" class="bouton bouton-blanc">Continuer les achats</a>
        <a href="../../backend/db_panier.php?action=vider" class="bouton bouton-blanc" 
           onclick="return confirm('Vider le panier ?')">Vider le panier</a>
      </div>

      <!-- Formulaire de paiement -->
      <div class="formulaire-paiement">
        <h3><i class="fa-solid fa-credit-card"></i> Informations de livraison et paiement</h3>
        
        <form method="POST" action="../../backend/commande.php" onsubmit="return validerFormulaire()">
          <div class="form-group">
            <label for="nom">Nom complet *</label>
            <input type="text" id="nom" name="nom" required>
          </div>

          <div class="form-group">
            <label for="telephone">Téléphone *</label>
            <input type="tel" id="telephone" name="telephone" required>
          </div>

          <div class="form-group">
            <label for="adresse">Adresse de livraison *</label>
            <textarea id="adresse" name="adresse" required></textarea>
          </div>

          <div class="form-group">
            <label for="mode_paiement">Mode de paiement *</label>
            <select id="mode_paiement" name="mode_paiement" required>
              <option value="">-- Choisir --</option>
              <option value="paiement_livraison">Paiement à la livraison</option>
              <option value="mobile_money">Mobile Money (TMoney, Flooz)</option>
              <option value="virement">Virement bancaire</option>
            </select>
          </div>

          <div class="form-group">
            <button type="submit" class="bouton" style="width: 100%;">
              <i class="fa-solid fa-check"></i> Valider la commande (<?php echo number_format($total, 0, ',', ' '); ?> FCFA)
            </button>
          </div>
        </form>
      </div>

    <?php endif; ?>
  </section>

  <footer class="footer">
    <div class="footer-contenu">
      <div class="footer-colonne"><h3>Velora</h3><p>Parfums, maquillage, soins, perruques et services beauté.</p></div>
      <div class="footer-colonne"><h3>Liens utiles</h3><ul><li><a href="main.php">Accueil</a></li><li><a href="boutique.php">Boutique</a></li></ul></div>
      <div class="footer-colonne"><h3>Contact</h3><p>Email: estherkpeglo273@gmail.com</p><p>Téléphone: 92 96 05 63</p><p>Adresse: ZOSSIME</p></div>
      <div class="footer-colonne"><h3>Compte</h3><ul><li><a href="connexion.php">Connexion</a></li><li><a href="inscription.php">Inscription</a></li><li><a href="panier.php">Panier</a></li></ul></div>
    </div>
    <p class="footer-copyright">Velora. Tous droits réservés.</p>
  </footer>

  <script>
    function validerFormulaire() {
      const nom = document.getElementById('nom').value.trim();
      const telephone = document.getElementById('telephone').value.trim();
      const adresse = document.getElementById('adresse').value.trim();
      const mode_paiement = document.getElementById('mode_paiement').value;

      if (!nom || !telephone || !adresse || !mode_paiement) {
        alert('Veuillez remplir tous les champs obligatoires.');
        return false;
      }

      return confirm('Confirmer la commande de ' + <?php echo $total; ?> + ' FCFA ?');
    }

    // Menu burger
    const menuBurger = document.getElementById('menuBurger');
    const navMenu = document.getElementById('navMenu');
    
    if (menuBurger && navMenu) {
      menuBurger.addEventListener('click', function() {
        menuBurger.classList.toggle('active');
        navMenu.classList.toggle('active');
      });
      
      const navLinks = navMenu.querySelectorAll('a');
      navLinks.forEach(link => {
        link.addEventListener('click', function() {
          menuBurger.classList.remove('active');
          navMenu.classList.remove('active');
        });
      });
    }

    // Dropdown utilisateur
    document.getElementById('userAvatar').addEventListener('click', function(e) {
      e.stopPropagation();
      const dropdown = document.getElementById('userDropdown');
      dropdown.classList.toggle('active');
    });

    document.addEventListener('click', function() {
      const dropdown = document.getElementById('userDropdown');
      dropdown.classList.remove('active');
    });

    document.getElementById('userDropdown').addEventListener('click', function(e) {
      e.stopPropagation();
    });
  </script>
</body>
</html>