<?php
require_once 'config.php';
require_once 'auth.php';

// Sécurité : Uniquement pour les étudiants connectés
require_login();

$user = get_user();

// Récupérer les inscriptions de l'utilisateur avec les détails des programmes
$stmt = $pdo->prepare("
    SELECT p.*, i.date_inscription 
    FROM inscriptions i 
    JOIN programmes p ON i.programme_id = p.id 
    WHERE i.user_id = ? 
    ORDER BY i.date_inscription DESC
");
$stmt->execute([$user['id']]);
$mes_formations = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace | MIA-Cameroun</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

    <?php include 'navbar.php'; ?>

    <div class="container py-5">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 gap-3">
            <div>
                <span class="section-tag mb-2">Espace Étudiant</span>
                <h1 class="fw-bold mb-1">Bienvenue, <?= htmlspecialchars($user['username']) ?></h1>
                <p class="text-muted small mb-0">Voici les programmes que vous suivez actuellement.</p>
            </div>
            <a href="programmes.php" class="btn btn-outline-primary rounded-pill px-4 py-2 border-2 fw-bold small"><i class="bi bi-search me-2"></i> Explorer de nouveaux programmes</a>
        </div>

        <div class="row g-4">
            <?php if (empty($mes_formations)): ?>
                <div class="col-12 text-center py-5">
                    <div class="card-mia border-0 shadow-sm p-5 bg-white">
                        <div class="fs-1 mb-3">🎓</div>
                        <h4 class="fw-bold">Vous n'êtes inscrit à aucun programme</h4>
                        <p class="text-muted mb-4">Parcourez notre catalogue pour commencer votre apprentissage.</p>
                        <a href="programmes.php" class="btn btn-accent rounded-pill px-5 py-3 shadow">Voir le catalogue</a>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($mes_formations as $prog): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card-mia h-100 border-0 shadow-sm p-4 d-flex flex-column bg-white transition-all hover-translate-y">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge rounded-pill bg-slate-50 text-accent px-3 py-2 border small"><?= htmlspecialchars($prog['type']) ?></span>
                            <span class="small text-muted"><i class="bi bi-calendar3 me-1"></i> <?= date('d/m/Y', strtotime($prog['date_inscription'])) ?></span>
                        </div>
                        <h5 class="fw-bold mb-2"><?= htmlspecialchars($prog['titre']) ?></h5>
                        <p class="text-muted small mb-4 flex-grow-1"><?= htmlspecialchars($prog['description']) ?></p>
                        
                        <div class="course-stats border-top pt-3 mt-auto">
                            <div class="d-flex align-items-center gap-2"><i class="bi bi-clock"></i> <span><?= htmlspecialchars($prog['duree']) ?></span></div>
                            <div class="d-flex align-items-center gap-2"><i class="bi bi-laptop"></i> <span><?= htmlspecialchars($prog['format']) ?></span></div>
                        </div>

                        <div class="mt-4">
                            <a href="#" class="btn btn-primary w-100 py-2 rounded-pill fw-bold small">Accéder au cours <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="bootstrap-5.3.8/bootstrap-5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
