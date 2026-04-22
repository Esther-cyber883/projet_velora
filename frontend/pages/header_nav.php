<?php
// ============================================================
// header_nav.php — Composant de navigation réutilisable
// Affiche dynamiquement les boutons selon l'état de connexion
// ============================================================

// Vérifier si l'utilisateur est connecté
$estaConectado = isset($_SESSION['id_utilisateur']);
?>

<header class="header">
  <div class="header-gauche">
    <i class="fa-solid fa-shop header-logo-icon" aria-hidden="true"></i>
    <span class="header-nom">Velora</span>
  </div>
  
  <nav class="header-nav" id="navMenu">
    <a href="main.php" class="actif">Accueil</a>
    <a href="boutique.php">Boutique</a>
    <a href="apropos.php">À propos</a>
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
        <?php if ($estaConectado): ?>
          <!-- Menu si l'utilisateur est connecté -->
          <span class="user-nom">Bonjour, <?php echo htmlspecialchars($_SESSION['nom']); ?> !</span>
          
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="admin/dashboard.php">
              <i class="fa-solid fa-gear"></i> Espace Admin
            </a>
          <?php endif; ?>
          
          <a href="../../backend/deconnexion.php">
            <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
          </a>
        <?php else: ?>
          <!-- Menu si l'utilisateur n'est pas connecté -->
          <a href="connexion.php">
            <i class="fa-solid fa-sign-in-alt"></i> Se connecter
          </a>
          <a href="inscription.php">
            <i class="fa-solid fa-user-plus"></i> S'inscrire
          </a>
        <?php endif; ?>
      </div>
    </div>
    
    <button class="menu-burger" id="menuBurger" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>
