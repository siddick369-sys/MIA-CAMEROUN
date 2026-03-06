<?php
require_once 'config.php';
require_once 'auth.php';

$user = get_user();

// Logique d'inscription
if (is_logged_in() && isset($_POST['enroll'])) {
    $programme_id = $_POST['programme_id'];
    $user_id = $user['id'];

    try {
        $stmt = $pdo->prepare("INSERT IGNORE INTO inscriptions (user_id, programme_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $programme_id]);
        $msg = "Inscription réussie !";
    } catch (PDOException $e) {
        $msg = "Erreur lors de l'inscription.";
    }
}

// Récupération des programmes par type
$stmt = $pdo->query("SELECT * FROM programmes ORDER BY type, titre");
$all_programmes = $stmt->fetchAll();

$formations = array_filter($all_programmes, function($p) { return $p['type'] === 'Formation'; });
$ateliers = array_filter($all_programmes, function($p) { return $p['type'] === 'Atelier'; });
$evenements = array_filter($all_programmes, function($p) { return $p['type'] === 'Événement'; });

// Récupérer les inscriptions de l'utilisateur
$user_inscriptions = [];
if (is_logged_in()) {
    $stmt = $pdo->prepare("SELECT programme_id FROM inscriptions WHERE user_id = ?");
    $stmt->execute([$user['id']]);
    $user_inscriptions = $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Programmes | MIA-Cameroun</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <!-- Banner -->
    <section class="hero-banner-mia border-bottom">
        <div class="container py-lg-4">
            <div class="text-center">
                <span class="section-tag">Catalogue</span>
                <h1 class="display-4 fw-bold mb-3">Explorez nos programmes</h1>
                <p class="text-muted mx-auto" style="max-width: 600px;">Développez les compétences de demain avec nos formations certifiantes et nos ateliers pratiques sur mesure.</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5">
        <?php if (isset($msg)): ?>
            <div class="alert alert-success rounded-premium shadow-sm border-0 p-3 mb-5 d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill fs-5"></i> <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <!-- Formations -->
        <div class="section-header mb-5">
            <h2 class="fw-bold"><i class="bi bi-mortarboard text-accent me-2"></i> Formations Certifiantes</h2>
            <p class="text-muted small">Parcours complets pour une expertise approfondie.</p>
        </div>

        <div class="row g-4 mb-5">
            <?php foreach ($formations as $prog): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card-mia h-100 d-flex flex-column border-0 shadow-sm transition-all hover-translate-y">
                    <div class="mb-3 d-flex justify-content-between align-items-start">
                        <span class="badge bg-slate-50 text-accent rounded-pill px-3 py-2 small border"><?= htmlspecialchars($prog['categorie']) ?></span>
                        <span class="text-muted small"><i class="bi bi-star-fill text-gold me-1"></i> 4.9</span>
                    </div>
                    <h5 class="fw-bold mb-3"><?= htmlspecialchars($prog['titre']) ?></h5>
                    <p class="text-muted small mb-4 flex-grow-1"><?= htmlspecialchars($prog['description'] ?: 'Aucune description disponible pour ce programme.') ?></p>
                    
                    <div class="course-stats pb-3 border-bottom mb-4">
                        <div class="d-flex align-items-center gap-2"><i class="bi bi-clock"></i> <span><?= htmlspecialchars($prog['duree']) ?></span></div>
                        <div class="d-flex align-items-center gap-2"><i class="bi bi-laptop"></i> <span><?= htmlspecialchars($prog['format']) ?></span></div>
                    </div>

                    <div class="mt-auto">
                        <?php if (is_logged_in()): ?>
                            <?php if (in_array($prog['id'], $user_inscriptions)): ?>
                                <button class="btn btn-success rounded-pill disabled w-100 fw-bold"><i class="bi bi-check2-circle me-2"></i>Déjà inscrit</button>
                            <?php else: ?>
                                <form method="POST">
                                    <input type="hidden" name="programme_id" value="<?= $prog['id'] ?>">
                                    <button type="submit" name="enroll" class="btn btn-accent rounded-pill w-100 py-2 shadow-sm">S'inscrire maintenant</button>
                                </form>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-outline-dark rounded-pill w-100 py-2">Se connecter pour s'inscrire</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <hr class="my-5 opacity-10">

        <!-- Ateliers & Events -->
        <div class="row g-5 mt-4">
            <div class="col-lg-6">
                <div class="section-header mb-4">
                    <h2 class="fw-bold"><i class="bi bi-tools text-accent me-2"></i> Ateliers Pratiques</h2>
                </div>
                <div class="row g-3">
                    <?php if (empty($ateliers)): ?>
                        <div class="col-12"><p class="text-muted fst-italic">Bientôt disponible...</p></div>
                    <?php endif; ?>
                    <?php foreach ($ateliers as $prog): ?>
                    <div class="col-12">
                        <div class="card-mia border-0 shadow-sm p-4 d-flex align-items-center gap-4">
                            <div class="bg-slate-50 p-3 rounded-circle text-accent fs-4"><i class="bi bi-rocket-takeoff"></i></div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1"><?= htmlspecialchars($prog['titre']) ?></h6>
                                <p class="text-muted small mb-0"><?= htmlspecialchars($prog['description']) ?></p>
                            </div>
                            <?php if (is_logged_in() && !in_array($prog['id'], $user_inscriptions)): ?>
                            <form method="POST">
                                <input type="hidden" name="programme_id" value="<?= $prog['id'] ?>">
                                <button type="submit" name="enroll" class="btn btn-sm btn-outline-accent rounded-pill px-3">Rejoindre</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="section-header mb-4">
                    <h2 class="fw-bold"><i class="bi bi-calendar-event text-accent me-2"></i> Événements & Meetups</h2>
                </div>
                <div class="row g-3">
                    <?php if (empty($evenements)): ?>
                        <div class="col-12"><p class="text-muted fst-italic">Aucun événement prévu pour le moment.</p></div>
                    <?php endif; ?>
                    <?php foreach ($evenements as $prog): ?>
                    <div class="col-12">
                        <div class="card-mia border-0 shadow-sm p-4 d-flex align-items-center gap-4">
                            <div class="bg-slate-50 p-3 rounded-circle text-gold fs-4"><i class="bi bi-award"></i></div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1"><?= htmlspecialchars($prog['titre']) ?></h6>
                                <p class="text-muted small mb-0"><?= htmlspecialchars($prog['description']) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="bootstrap-5.3.8/bootstrap-5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
