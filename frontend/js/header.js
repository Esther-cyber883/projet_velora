// ============================================================
// header.js — Gestion du menu utilisateur et du menu burger
// ============================================================

document.addEventListener('DOMContentLoaded', function() {
  // Éléments du DOM
  const userAvatar = document.getElementById('userAvatar');
  const userDropdown = document.getElementById('userDropdown');
  const menuBurger = document.getElementById('menuBurger');
  const navMenu = document.getElementById('navMenu');

  // ============================================================
  // MENU UTILISATEUR (dropdown)
  // ============================================================
  if (userAvatar && userDropdown) {
    userAvatar.addEventListener('click', function(e) {
      e.stopPropagation();
      userDropdown.classList.toggle('active');
    });

    // Fermer le dropdown si on clique ailleurs
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.user-menu')) {
        userDropdown.classList.remove('active');
      }
    });

    // Fermer le dropdown quand on clique sur un lien
    const dropdownLinks = userDropdown.querySelectorAll('a');
    dropdownLinks.forEach(link => {
      link.addEventListener('click', function() {
        userDropdown.classList.remove('active');
      });
    });
  }

  // ============================================================
  // MENU BURGER (responsive)
  // ============================================================
  if (menuBurger && navMenu) {
    menuBurger.addEventListener('click', function(e) {
      e.stopPropagation();
      navMenu.classList.toggle('active');
    });

    // Fermer le menu quand on clique sur un lien
    const navLinks = navMenu.querySelectorAll('a');
    navLinks.forEach(link => {
      link.addEventListener('click', function() {
        navMenu.classList.remove('active');
      });
    });

    // Fermer le menu si on clique ailleurs
    document.addEventListener('click', function(e) {
      if (!e.target.closest('.header')) {
        navMenu.classList.remove('active');
      }
    });
  }
});
