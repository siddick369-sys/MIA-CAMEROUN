<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mission, vision et valeurs de la MIA-Cameroun — Maison de l'Intelligence Artificielle au Cameroun.">
    <title>À Propos | MIA-Cameroun</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'navbar.php'; ?>

    <!-- Banner -->
    <section class="hero-banner-mia border-bottom">
        <div class="container py-lg-4">
            <div class="text-center">
                <span class="section-tag">Notre Histoire</span>
                <h1 class="display-4 fw-bold mb-3">L'intelligence au service de l'avenir</h1>
                <p class="text-muted mx-auto" style="max-width: 600px;">La MIA-Cameroun est le catalyseur de la transformation numérique à travers l'Intelligence Artificielle au service du développement durable.</p>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-5 py-md-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="logo.jpeg" alt="Story" class="img-fluid rounded-4 shadow-lg border-8 border-white">
                </div>
                <div class="col-lg-6">
                    <div class="section-header mb-4">
                        <span class="section-tag">Qui sommes-nous ?</span>
                        <h2 class="fw-bold display-6">Notre Mission</h2>
                    </div>
                    <p class="mb-4 text-muted">La <strong>Maison de l'Intelligence Artificielle du Cameroun (MIA-Cameroun)</strong> est née de la volonté de démocratiser l'accès aux technologies de pointe sur l'ensemble du territoire national.</p>
                    <p class="mb-4 text-muted">Nous œuvrons chaque jour pour créer un pont entre les talents camerounais et les opportunités mondiales de l'économie numérique grâce à :</p>
                    <ul class="list-unstyled d-grid gap-3 mb-5">
                        <li class="d-flex gap-3 align-items-center"><div class="bg-slate-100 rounded-circle p-2 text-accent fs-5"><i class="bi bi-check-lg"></i></div> <span class="fw-bold small">Formation intensive et certifiante</span></li>
                        <li class="d-flex gap-3 align-items-center"><div class="bg-slate-100 rounded-circle p-2 text-accent fs-5"><i class="bi bi-check-lg"></i></div> <span class="fw-bold small">Soutien à l'innovation et à l'entreprenariat</span></li>
                        <li class="d-flex gap-3 align-items-center"><div class="bg-slate-100 rounded-circle p-2 text-accent fs-5"><i class="bi bi-check-lg"></i></div> <span class="fw-bold small">Accompagnement des entreprises locales</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Grid -->
    <section class="py-5 bg-slate-50 border-top border-bottom">
        <div class="container py-4">
            <div class="text-center section-header mb-5">
                <span class="section-tag">Valeurs</span>
                <h2 class="fw-bold">Ce qui nous définit</h2>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3">
                    <div class="card-mia border-0 p-4 text-center bg-white h-100">
                        <div class="bg-slate-50 rounded-3 d-inline-flex p-3 text-accent fs-4 mb-3"><i class="bi bi-lightbulb"></i></div>
                        <h6 class="fw-bold mb-2">Innovation</h6>
                        <p class="text-muted small mb-0">Nous repoussons sans cesse les limites du possible.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card-mia border-0 p-4 text-center bg-white h-100">
                        <div class="bg-slate-50 rounded-3 d-inline-flex p-3 text-accent fs-4 mb-3"><i class="bi bi-infinity"></i></div>
                        <h6 class="fw-bold mb-2">Excellence</h6>
                        <p class="text-muted small mb-0">La qualité est au centre de toutes nos formations.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card-mia border-0 p-4 text-center bg-white h-100">
                        <div class="bg-slate-50 rounded-3 d-inline-flex p-3 text-accent fs-4 mb-3"><i class="bi bi-unity"></i></div>
                        <h6 class="fw-bold mb-2">Collaboration</h6>
                        <p class="text-muted small mb-0">Un écosystème uni pour réussir ensemble.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card-mia border-0 p-4 text-center bg-white h-100">
                        <div class="bg-slate-50 rounded-3 d-inline-flex p-3 text-accent fs-4 mb-3"><i class="bi bi-shield-check"></i></div>
                        <h6 class="fw-bold mb-2">Éthique</h6>
                        <p class="text-muted small mb-0">Une IA responsable au service de l'humain.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="bootstrap-5.3.8/bootstrap-5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
