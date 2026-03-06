<?php
require_once 'config.php';
require_once 'auth.php';

if (is_logged_in()) {
    header("Location: " . (is_admin() ? "admin.php" : "mes-formations.php"));
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: " . ($user['role'] === 'admin' ? "admin.php" : "mes-formations.php"));
            exit();
        } else {
            $error = "Identifiants invalides.";
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
    <title>Connexion | MIA-Cameroun</title>
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
                    <h2 class="fw-bold">Bon retour parmi nous</h2>
                    <p class="text-muted small">Connectez-vous pour accéder à vos formations</p>
                </div>

                <div class="card-mia border-0 shadow-lg p-5">
                    <?php if ($error): ?>
                        <div class="alert alert-danger border-0 rounded-3 small mb-4 py-3 d-flex align-items-center gap-2">
                           <i class="bi bi-exclamation-triangle-fill"></i> <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-slate-700">Nom d'utilisateur</label>
                            <input type="text" name="username" class="form-control-mia w-100" placeholder="Ex: JeanDupont" required>
                        </div>
                        <div class="mb-5">
                            <div class="d-flex justify-content-between">
                                <label class="form-label small fw-bold text-slate-700">Mot de passe</label>
                                <a href="#" class="small text-accent fw-bold text-decoration-none">Oublié ?</a>
                            </div>
                            <input type="password" name="password" class="form-control-mia w-100" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm">Se connecter</button>
                    </form>

                    <div class="text-center mt-5">
                        <p class="small text-muted mb-0">Pas de compte ? <a href="register.php" class="text-accent fw-bold text-decoration-none">Inscrivez-vous ici</a></p>
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
