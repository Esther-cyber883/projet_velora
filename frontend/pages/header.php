
  <header class="header">
    <div class="header-gauche">
      <i class="fa-solid fa-shop header-logo-icon" aria-hidden="true"></i>
      <span class="header-nom">Velora</span>
    </div>
    <nav class="header-nav" id="navMenu">
      <a href="main.php" class="actif">Accueil</a>
      <a href="boutique.php">Boutique</a>
      <a href="#Apropos">À propos</a>
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
          <!-- L'utilisateur est forcément connecté ici -->
          <span class="user-nom">Bonjour, <?php echo htmlspecialchars($_SESSION['nom']); ?> !</span>
          <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="admin/dashboard.php"><i class="fa-solid fa-gear"></i> Espace Admin</a>
          <?php endif; ?>
          <a href="../../backend/deconnexion.php">
            <i class="fa-solid fa-right-from-bracket"></i> Déconnexion
          </a>
        </div>
      </div>
      <button class="menu-burger" id="menuBurger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>