<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'exo_mia_db';
$username = 'root'; // À adapter selon votre config locale (XAMPP/WAMP)
$password = '';     // À adapter

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Configurer PDO pour lever des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Mode de récupération par défaut : tableau associatif
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
