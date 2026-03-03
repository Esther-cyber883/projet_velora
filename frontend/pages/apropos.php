<?php include '../../backend/db.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Velora - À propos</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* ===== HERO ===== */
    .apropos-hero {
      position: relative;
      height: 420px;
      background: linear-gradient(135deg, #1a1a2e 0%, #6b2d5e 50%, #c07a9a 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      overflow: hidden;
    }
    .apropos-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url('../images/maqq.jpg') center/cover no-repeat;
      opacity: 0.18;
    }
    .apropos-hero-contenu {
      position: relative;
      z-index: 2;
      color: white;
    }
    .apropos-hero-contenu h1 {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 14px;
      letter-spacing: 2px;
    }
    .apropos-hero-contenu p {
      font-size: 1.2rem;
      opacity: 0.88;
      max-width: 560px;
      line-height: 1.7;
    }
    .hero-trait {
      width: 70px;
      height: 4px;
      background: #f0b8d0;
      margin: 18px auto;
      border-radius: 2px;
    }

    /* ===== SECTIONS ===== */
    .apropos-section {
      max-width: 1100px;
      margin: 70px auto;
      padding: 0 24px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
    }
    .apropos-section.inverse {
      direction: rtl;
    }
    .apropos-section.inverse > * {
      direction: ltr;
    }
    .apropos-img {
      width: 100%;
      height: 360px;
      object-fit: cover;
      border-radius: 20px;
      box-shadow: 0 16px 48px rgba(0,0,0,0.14);
    }
    .apropos-img-ronde {
      border-radius: 50% 20% 50% 20%;
    }
    .apropos-texte {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    .apropos-badge {
      display: inline-block;
      background: #fce4f0;
      color: #b5446e;
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 0.82rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      width: fit-content;
    }
    .apropos-texte h2 {
      font-size: 2rem;
      color: #2d2d2d;
      font-weight: 800;
      line-height: 1.3;
      margin: 0;
    }
    .apropos-texte h2 em {
      color: #b5446e;
      font-style: normal;
    }
    .apropos-texte p {
      font-size: 1rem;
      color: #666;
      line-height: 1.85;
      margin: 0;
    }
    .apropos-texte .citation {
      border-left: 4px solid #c07a9a;
      padding-left: 18px;
      font-style: italic;
      color: #888;
      font-size: 1.05rem;
      line-height: 1.7;
    }

    /* ===== CHIFFRES ===== */
    .chiffres-section {
      background: linear-gradient(135deg, #6b2d5e, #c07a9a);
      padding: 60px 24px;
      text-align: center;
      color: white;
    }
    .chiffres-section h2 {
      font-size: 1.8rem;
      margin-bottom: 40px;
      opacity: 0.92;
    }
    .chiffres-grille {
      display: flex;
      justify-content: center;
      gap: 60px;
      flex-wrap: wrap;
      max-width: 900px;
      margin: 0 auto;
    }
    .chiffre-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 8px;
    }
    .chiffre-item i {
      font-size: 2.2rem;
      opacity: 0.85;
      margin-bottom: 6px;
    }
    .chiffre-item span {
      font-size: 3rem;
      font-weight: 800;
    }
    .chiffre-item p {
      font-size: 0.95rem;
      opacity: 0.82;
      margin: 0;
    }

    /* ===== VALEURS ===== */
    .valeurs-section {
      max-width: 1100px;
      margin: 70px auto;
      padding: 0 24px;
      text-align: center;
    }
    .valeurs-section h2 {
      font-size: 2rem;
      color: #2d2d2d;
      margin-bottom: 10px;
    }
    .valeurs-section > p {
      color: #888;
      margin-bottom: 40px;
    }
    .valeurs-grille {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 28px;
    }
    .valeur-card {
      background: white;
      border-radius: 20px;
      padding: 36px 24px;
      box-shadow: 0 8px 32px rgba(176,68,110,0.08);
      border: 1px solid #f5e0eb;
      transition: transform 0.3s;
    }
    .valeur-card:hover {
      transform: translateY(-6px);
    }
    .valeur-icon {
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, #fce4f0, #f0b8d0);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 18px;
      font-size: 1.6rem;
      color: #b5446e;
    }
    .valeur-card h3 {
      font-size: 1.15rem;
      color: #2d2d2d;
      margin-bottom: 10px;
    }
    .valeur-card p {
      font-size: 0.92rem;
      color: #888;
      line-height: 1.7;
    }

    /* ===== EQUIPE ===== */
    .equipe-section {
      background: #fdf5f9;
      padding: 70px 24px;
      text-align: center;
    }
    .equipe-section h2 {
      font-size: 2rem;
      color: #2d2d2d;
      margin-bottom: 8px;
    }
    .equipe-section > p {
      color: #888;
      margin-bottom: 40px;
    }
    .equipe-grille {
      display: flex;
      justify-content: center;
      gap: 36px;
      flex-wrap: wrap;
      max-width: 900px;
      margin: 0 auto;
    }
    .equipe-card {
      background: white;
      border-radius: 20px;
      padding: 28px 24px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.07);
      width: 220px;
      text-align: center;
    }
    .equipe-avatar {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      background: linear-gradient(135deg, #c07a9a, #b5446e);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 14px;
      font-size: 2rem;
      color: white;
    }
    .equipe-card h3 {
      font-size: 1rem;
      color: #2d2d2d;
      margin-bottom: 4px;
    }
    .equipe-card p {
      font-size: 0.85rem;
      color: #b5446e;
      font-weight: 600;
    }
    .equipe-card small {
      font-size: 0.8rem;
      color: #aaa;
      line-height: 1.5;
      display: block;
      margin-top: 8px;
    }

    /* ===== CTA ===== */
    .cta-section {
      text-align: center;
      padding: 70px 24px;
      background: white;
    }
    .cta-section h2 {
      font-size: 2rem;
      color: #2d2d2d;
      margin-bottom: 12px;
    }
    .cta-section p {
      color: #888;
      margin-bottom: 28px;
      font-size: 1.05rem;
    }
    .cta-boutons {
      display: flex;
      justify-content: center;
      gap: 16px;
      flex-wrap: wrap;
    }
    .btn-cta {
      padding: 14px 32px;
      border-radius: 30px;
      font-size: 1rem;
      font-weight: 600;
      text-decoration: none;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-cta:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    .btn-rose { background: #b5446e; color: white; }
    .btn-blanc { background: white; color: #b5446e; border: 2px solid #b5446e; }

    @media (max-width: 768px) {
      .apropos-section { grid-template-columns: 1fr; gap: 28px; }
      .apropos-section.inverse { direction: ltr; }
      .valeurs-grille { grid-template-columns: 1fr; }
      .chiffres-grille { gap: 32px; }
      .apropos-hero-contenu h1 { font-size: 2rem; }
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header class="header">
    <div class="header-gauche">
      <i class="fa-solid fa-shop header-logo-icon"></i>
      <span class="header-nom">Velora</span>
    </div>
    <nav class="header-nav" id="navMenu">
      <a href="main.php">Accueil</a>
      <a href="boutique.php">Boutique</a>
      <a href="apropos.php" class="actif">À propos</a>
    </nav>
    <div class="header-droite">
      <a href="panier.php" class="header-action header-panier">
        <i class="fa-solid fa-cart-shopping"></i>
      </a>
      <div class="user-menu">
        <button class="user-avatar" id="userAvatar">
          <i class="fa-solid fa-user"></i>
        </button>
        <div class="user-dropdown" id="userDropdown">
          <?php if (isset($_SESSION['id_utilisateur'])): ?>
            <span class="user-nom">Bonjour, <?php echo htmlspecialchars($_SESSION['nom']); ?> !</span>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
              <a href="admin/dashboard.php"><i class="fa-solid fa-gear"></i> Espace Admin</a>
            <?php endif; ?>
            <a href="../../backend/deconnexion.php"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
          <?php else: ?>
            <a href="connexion.php">Se connecter</a>
          <?php endif; ?>
        </div>
      </div>
      <button class="menu-burger" id="menuBurger">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>

  <!-- HERO -->
  <section class="apropos-hero">
    <div class="apropos-hero-contenu">
      <h1>Notre Histoire</h1>
      <div class="hero-trait"></div>
      <p>Une passion pour la beauté, née d'un rêve simple : rendre chaque femme unique et lumineuse.</p>
    </div>
  </section>

  <!-- SECTION 1 : La naissance -->
  <section class="apropos-section">
    <img src="../images/maqq.jpg" alt="Naissance de Velora" class="apropos-img apropos-img-ronde">
    <div class="apropos-texte">
      <span class="apropos-badge">Notre origine</span>
      <h2>Née d'une <em>passion</em> profonde</h2>
      <p>
        Tout a commencé dans un petit appartement à Zossime, avec une femme, un miroir, et une conviction
        inébranlable : chaque femme mérite de se sentir belle, peu importe son budget.
      </p>
      <p>
        Esther KPEGLO, fondatrice de Velora, a grandi en voyant sa mère se battre pour trouver
        des produits de qualité à des prix accessibles. Cette frustration est devenue sa motivation,
        et Velora est née de cette émotion.
      </p>
      <p class="citation">
        "Je voulais créer un espace où chaque femme se sente belle, comprise et valorisée.
        Velora, c'est mon cœur mis en boutique."
        <br><strong>— Esther KPEGLO, Fondatrice</strong>
      </p>
    </div>
  </section>

  <!-- CHIFFRES -->
  <section class="chiffres-section">
    <h2>Velora en chiffres</h2>
    <div class="chiffres-grille">
      <div class="chiffre-item">
        <i class="fa-solid fa-heart"></i>
        <span>500+</span>
        <p>Clientes satisfaites</p>
      </div>
      <div class="chiffre-item">
        <i class="fa-solid fa-box"></i>
        <span>100+</span>
        <p>Produits sélectionnés</p>
      </div>
      <div class="chiffre-item">
        <i class="fa-solid fa-star"></i>
        <span>4.9</span>
        <p>Note moyenne</p>
      </div>
      <div class="chiffre-item">
        <i class="fa-solid fa-calendar"></i>
        <span>3 ans</span>
        <p>D'expérience</p>
      </div>
    </div>
  </section>

  <!-- SECTION 2 : Les difficultés -->
  <section class="apropos-section inverse">
    <img src="../images/soiiin.webp" alt="Les débuts difficiles" class="apropos-img">
    <div class="apropos-texte">
      <span class="apropos-badge">Les débuts</span>
      <h2>Des larmes aux <em>victoires</em></h2>
      <p>
        Les premiers mois n'ont pas été faciles. Sans capital, sans local, avec seulement
        quelques produits dans un sac, Esther vendait de porte en porte, le sourire comme
        seul outil de persuasion.
      </p>
      <p>
        Il y a eu des jours où les doutes étaient plus forts que la foi. Des nuits où les
        chiffres ne s'additionnaient pas. Mais chaque cliente qui repartait heureuse était
        une raison de continuer.
      </p>
      <p class="citation">
        "Quand une cliente me dit que grâce à Velora elle s'est sentie belle pour son mariage,
        tous les sacrifices s'effacent d'un coup."
      </p>
    </div>
  </section>

  <!-- SECTION 3 : Aujourd'hui -->
  <section class="apropos-section">
    <img src="../images/parrf.webp" alt="Velora aujourd'hui" class="apropos-img">
    <div class="apropos-texte">
      <span class="apropos-badge">Aujourd'hui</span>
      <h2>Une boutique, <em>des milliers</em> de sourires</h2>
      <p>
        Aujourd'hui Velora est bien plus qu'une boutique. C'est une communauté de femmes
        qui se soutiennent, qui partagent leurs astuces beauté et qui célèbrent leur
        féminité ensemble.
      </p>
      <p>
        Des parfums envoûtants aux perruques naturelles, en passant par les soins
        et le maquillage, chaque produit est sélectionné avec amour et exigence.
        Parce que vous méritez ce qu'il y a de mieux.
      </p>
      <p class="citation">
        "Velora grandit chaque jour grâce à vous. Vous êtes notre plus belle récompense."
      </p>
    </div>
  </section>

  <!-- VALEURS -->
  <section class="valeurs-section">
    <h2>Nos valeurs</h2>
    <p>Ce qui nous guide chaque jour</p>
    <div class="valeurs-grille">
      <div class="valeur-card">
        <div class="valeur-icon"><i class="fa-solid fa-heart"></i></div>
        <h3>Passion</h3>
        <p>Chaque produit est choisi avec amour. Nous ne proposons que ce que nous utiliserions nous-mêmes.</p>
      </div>
      <div class="valeur-card">
        <div class="valeur-icon"><i class="fa-solid fa-shield-halved"></i></div>
        <h3>Qualité</h3>
        <p>Nous sélectionnons rigoureusement nos fournisseurs pour garantir des produits sûrs et efficaces.</p>
      </div>
      <div class="valeur-card">
        <div class="valeur-icon"><i class="fa-solid fa-users"></i></div>
        <h3>Communauté</h3>
        <p>Velora c'est une famille. Chaque cliente est une sœur que l'on accompagne dans son parcours beauté.</p>
      </div>
      <div class="valeur-card">
        <div class="valeur-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
        <h3>Bienveillance</h3>
        <p>Nous croyons que la beauté est pour toutes. Aucun standard, aucun jugement — juste de l'amour.</p>
      </div>
      <div class="valeur-card">
        <div class="valeur-icon"><i class="fa-solid fa-leaf"></i></div>
        <h3>Authenticité</h3>
        <p>Nous sommes honnêtes sur nos produits, nos prix et nos valeurs. La confiance avant tout.</p>
      </div>
      <div class="valeur-card">
        <div class="valeur-icon"><i class="fa-solid fa-star"></i></div>
        <h3>Excellence</h3>
        <p>Nous visons toujours le meilleur — dans nos produits comme dans notre service clientèle.</p>
      </div>
    </div>
  </section>

  <!-- EQUIPE -->
  <section class="equipe-section">
    <h2>Notre équipe</h2>
    <p>Des personnes passionnées au service de votre beauté</p>
    <div class="equipe-grille">
      <div class="equipe-card">
        <div class="equipe-avatar"><i class="fa-solid fa-user"></i></div>
        <h3>Esther KPEGLO</h3>
        <p>Fondatrice & Directrice</p>
        <small>Passionnée de beauté depuis l'enfance, elle a transformé son rêve en réalité.</small>
      </div>
      <div class="equipe-card">
        <div class="equipe-avatar"><i class="fa-solid fa-user"></i></div>
        <h3>Équipe Conseil</h3>
        <p>Conseillères Beauté</p>
        <small>Toujours disponibles pour vous guider vers les produits qui vous correspondent.</small>
      </div>
      <div class="equipe-card">
        <div class="equipe-avatar"><i class="fa-solid fa-user"></i></div>
        <h3>Équipe Livraison</h3>
        <p>Logistique & Livraison</p>
        <small>Vos commandes livrées avec soin et dans les meilleurs délais.</small>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta-section">
    <h2>Prête à rejoindre la famille Velora ?</h2>
    <p>Découvrez nos produits soigneusement sélectionnés pour vous.</p>
    <div class="cta-boutons">
      <a href="boutique.php" class="btn-cta btn-rose">
        <i class="fa-solid fa-shop"></i> Découvrir la boutique
      </a>
      <a href="connexion.php" class="btn-cta btn-blanc">
        <i class="fa-solid fa-user"></i> Rejoindre Velora
      </a>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-contenu">
      <div class="footer-colonne"><h3>Velora</h3><p>Parfums, maquillage, soins, perruques et services beauté.</p></div>
      <div class="footer-colonne"><h3>Liens utiles</h3><ul>
        <li><a href="main.php">Accueil</a></li>
        <li><a href="boutique.php">Boutique</a></li>
        <li><a href="apropos.php">À propos</a></li>
      </ul></div>
      <div class="footer-colonne"><h3>Contact</h3>
        <p>Email: estherkpeglo273@gmail.com</p>
        <p>Téléphone: 92 96 05 63</p>
        <p>Adresse: ZOSSIME</p>
      </div>
      <div class="footer-colonne"><h3>Compte</h3><ul>
        <li><a href="connexion.php">Connexion</a></li>
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

</body>
</html>