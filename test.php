<?php
session_start();
echo "<h2>Contenu de la session :</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h2>Test connexion BDD :</h2>";
try {
    $dbpdo = new PDO("mysql:host=localhost;dbname=velora_db;charset=utf8", "root", "");
    echo "✅ BDD connectée<br>";
    
    $stmt = $dbpdo->query("SELECT id_utilisateur, email, role FROM utilisateur");
    $users = $stmt->fetchAll();
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Email</th><th>Role</th></tr>";
    foreach ($users as $u) {
        echo "<tr><td>{$u['id_utilisateur']}</td><td>{$u['email']}</td><td><strong>{$u['role']}</strong></td></tr>";
    }
    echo "</table>";
} catch (Exception $e) {
    echo "❌ Erreur BDD : " . $e->getMessage();
}
?>