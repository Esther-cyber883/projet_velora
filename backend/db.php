<?php
// Activer le buffering pour empêcher les sorties accidentelles
if (!ob_get_level()) {
    ob_start();
}

// Démarrer la session une seule fois pour tout le site
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Paramètres de connexion à la base de données
$db_host = '127.0.0.1';
$db_name = 'velora_db';
$db_user = 'root';
$db_pass = '';

// Connexion PDO avec gestion d'erreur
try {
    $dbpdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8",
        $db_user,
        $db_pass
    );
    // Activer les exceptions PDO pour attraper les erreurs SQL
    $dbpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Retourner les résultats sous forme de tableau associatif par défaut
    $dbpdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Afficher un message lisible sans exposer les détails techniques
    die("Erreur de connexion à la base de données. Contactez l'administrateur.");
}