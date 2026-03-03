<?php
include 'db.php'; // Pour la session

// Détruire toutes les données de la session
$_SESSION = [];
session_destroy();

// Rediriger vers la page de connexion
header('Location: ../frontend/pages/connexion.php');
exit();
?>

