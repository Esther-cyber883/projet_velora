<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: /Velora/frontend/pages/connexion.php');
    exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /Velora/frontend/pages/main.php');
    exit();
}

include 'C:/wamp64/www/Velora/backend/db.php';
?>