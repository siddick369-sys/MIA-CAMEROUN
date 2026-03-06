<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MIA-Cameroun — La Maison de l'Intelligence Artificielle au Cameroun.">
    <title>MIA-Cameroun | Excellence en IA</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <!-- Hero Section -->
    <header class="hero-banner-mia py-5 py-md-5">
        <div class="container py-lg-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-7 text-center text-lg-start">
                    <span class="section-tag">Pionnier de l'IA au Cameroun</span>
                    <h1 class="display-3 fw-bold mb-4" style="line-height: 1.1;">L'Intelligence Artificielle <span class="text-accent">Accessible à Tous</span></h1>
                    <p class="lead text-muted mb-5 pe-lg-5">Développez vos compétences avec nos programmes d'excellence, rejoignez une communauté d'experts et transformez l'avenir technologique de l'Afrique.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                        <a href="programmes.php" class="btn btn-accent btn-lg px-5 rounded-pill shadow-lg">Découvrir nos programmes</a>
                        <a href="a-propos.php" class="btn btn-outline-dark btn-lg px-5 rounded-pill">Notre mission</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="position-relative">
                        <div class="bg-accent rounded-circle position-absolute blur-3xl opacity-10" style="width: 300px; height: 300px; top: -50px; right: -50px;"></div>
                        <img src="logo.jpeg" alt="Hero MIA" class="img-fluid rounded-4 shadow-lg position-relative" style="border: 8px solid white;">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Stats & Trust -->
    <section class="py-5 border-bottom bg-white">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-6 col-md-3">
                    <h3 class="fw-bold mb-1">500+</h3>
                    <p class="small text-muted text-uppercase fw-bold">Étudiants formés</p>
                </div>
                <div class="col-6 col-md-3">
                    <h3 class="fw-bold mb-1">20+</h3>
                    <p class="small text-muted text-uppercase fw-bold">Experts certifiés</p>
                </div>
                <div class="col-6 col-md-3">
                    <h3 class="fw-bold mb-1">15+</h3>
                    <p class="small text-muted text-uppercase fw-bold">Partenaires</p>
                </div>
                <div class="col-6 col-md-3">
                    <h3 class="fw-bold mb-1">05</h3>
                    <p class="small text-muted text-uppercase fw-bold">Centres d'excellence</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Us -->
    <section class="py-5 py-md-5">
        <div class="container">
            <div class="text-center section-header mb-5">
                <span class="section-tag">Avantages</span>
                <h2 class="display-5 fw-bold">Pourquoi choisir MIA-Cameroun ?</h2>
                <div class="mx-auto mt-3" style="width: 60px; height: 4px; background: var(--mia-accent); border-radius: 10px;"></div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card-mia h-100 p-5">
                        <div class="bg-slate-50 rounded-3 d-inline-flex p-3 text-accent fs-3 mb-4"><i class="bi bi-mortarboard"></i></div>
                        <h4 class="fw-bold mb-3">Cursus d'Excellence</h4>
                        <p class="text-muted small">Des formations conçues par des experts internationaux adaptées aux défis du marché local.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-mia h-100 p-5">
                        <div class="bg-slate-50 rounded-3 d-inline-flex p-3 text-accent fs-3 mb-4"><i class="bi bi-people"></i></div>
                        <h4 class="fw-bold mb-3">Communauté Vibrante</h4>
                        <p class="text-muted small">Échangez avec des passionnés d'IA et participez à nos hackathons et meetups réguliers.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-mia h-100 p-5">
                        <div class="bg-slate-50 rounded-3 d-inline-flex p-3 text-accent fs-3 mb-4"><i class="bi bi-rocket-takeoff"></i></div>
                        <h4 class="fw-bold mb-3">Accompagnement</h4>
                        <p class="text-muted small">De l'initiation à l'insertion professionnelle, nous vous guidons à chaque étape de votre parcours IA.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white text-center position-relative overflow-hidden">
        <div class="bg-accent rounded-circle position-absolute blur-3xl opacity-20" style="width: 500px; height: 500px; bottom: -200px; left: -200px;"></div>
        <div class="container py-4 position-relative">
            <h2 class="display-5 fw-bold mb-4">Prêt à façonner l'avenir ?</h2>
            <p class="lead mb-5 opacity-75">Inscrivez-vous dès aujourd'hui et commencez votre voyage dans l'univers de l'IA.</p>
            <a href="register.php" class="btn btn-gold btn-lg px-5 rounded-pill shadow">Créer mon compte maintenant</a>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="bootstrap-5.3.8/bootstrap-5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
