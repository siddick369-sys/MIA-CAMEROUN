<?php
require_once 'config.php';
require_once 'auth.php';

if (is_logged_in()) {
    header("Location: programmes.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!empty($username) && !empty($password)) {
        if ($password !== $confirm_password) {
            $error = "Les mots de passe ne correspondent pas.";
        } else {
            // Vérifier si l'utilisateur existe déjà
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetchColumn() > 0) {
                $error = "Ce nom d'utilisateur est déjà pris.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'student')");
                if ($stmt->execute([$username, $hashed_password])) {
                    $success = "Compte créé avec succès ! Connectez-vous.";
                } else {
                    $error = "Une erreur est survenue.";
                }
            }
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | MIA-Cameroun</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="padding-top: 0; background-color: #f8fafc;">

    <div class="container h-100">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-10 col-lg-5">
                <div class="text-center mb-5">
                    <a href="index.php">
                        <img src="logo.jpeg" alt="Logo MIA" class="rounded-3 shadow-sm mb-3" style="height: 60px;">
                    </a>
                    <h2 class="fw-bold">Prêt pour l'aventure ?</h2>
                    <p class="text-muted small">Créez votre compte MIA-Cameroun en quelques secondes</p>
                </div>

                <div class="card-mia border-0 shadow-lg p-5">
                    <?php if ($error): ?>
                        <div class="alert alert-danger border-0 rounded-3 small mb-4 py-3">
                           <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success border-0 rounded-3 small mb-4 py-3">
                           <i class="bi bi-check-circle-fill me-2"></i> <?= htmlspecialchars($success) ?>
                           <br><a href="login.php" class="alert-link">Allez à la page de connexion</a>
                        </div>
                    <?php endif; ?>

                    <?php if (!$success): ?>
                    <form method="POST">
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-slate-700">Nom d'utilisateur</label>
                            <input type="text" name="username" class="form-control-mia w-100" placeholder="Ex: JeanDupont" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-slate-700">Mot de passe</label>
                            <input type="password" name="password" class="form-control-mia w-100" placeholder="••••••••" required>
                        </div>
                        <div class="mb-5">
                            <label class="form-label small fw-bold text-slate-700">Confirmer le mot de passe</label>
                            <input type="password" name="confirm_password" class="form-control-mia w-100" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-accent w-100 py-3 rounded-pill fw-bold shadow-sm">Créer mon compte</button>
                    </form>
                    <?php endif; ?>

                    <div class="text-center mt-5">
                        <p class="small text-muted mb-0">Déjà inscrit ? <a href="login.php" class="text-accent fw-bold text-decoration-none">Connectez-vous</a></p>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <a href="index.php" class="text-muted small text-decoration-none"><i class="bi bi-arrow-left me-1"></i> Retour à l'accueil</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
