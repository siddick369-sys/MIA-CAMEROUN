<?php
require_once 'config.php';

try {
    // 1. Assurons-nous que la table existe (au cas où le script SQL n'a pas été exécuté)
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'student') DEFAULT 'student',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    // 2. Supprimer l'ancien admin s'il existe pour éviter les erreurs d'unicité lors du reset
    $pdo->exec("DELETE FROM users WHERE username = 'admin'");

    // 3. Créer le nouvel admin avec admin123
    $username = 'admin';
    $password = 'admin123';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')");
    $stmt->execute([$username, $hashed_password]);

    echo "<div style='font-family: Arial; padding: 40px; text-align: center; color: #0b1d35;'>";
    echo "<h1>✅ Configuration de l'Admin réussie !</h1>";
    echo "<hr style='max-width: 400px; opacity: 0.2;'>";
    echo "<p>Utilisateur : <strong style='color: #d4a017;'>admin</strong></p>";
    echo "<p>Mot de passe : <strong style='color: #d4a017;'>admin123</strong></p>";
    echo "<br>";
    echo "<a href='login.php' style='display: inline-block; padding: 12px 24px; background: #0b1d35; color: white; text-decoration: none; border-radius: 8px; font-weight: bold;'>Aller à la page de connexion</a>";
    echo "</div>";

} catch (PDOException $e) {
    echo "<div style='color: red; padding: 20px;'>";
    echo "<h1>❌ Erreur lors de la configuration</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "</div>";
}
?>
