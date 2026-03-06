<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contactez la MIA-Cameroun pour toute question sur nos programmes en Intelligence Artificielle.">
    <title>Contactez-nous | MIA-Cameroun</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
</head>
<body class="bg-light">

    <?php include 'navbar.php'; ?>

    <div class="container py-5">
        <div class="text-center mb-5 mt-lg-4">
            <span class="section-tag mb-2">Support & Contact</span>
            <h1 class="display-5 fw-bold mb-3">Nous sommes à votre écoute</h1>
            <p class="text-muted mx-auto" style="max-width: 600px;">Que vous ayez une question sur nos formations ou un projet de collaboration, notre équipe vous répondra dans les plus brefs délais.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Info Sidebar -->
            <div class="col-lg-4">
                <div class="card-mia border-0 shadow-lg p-5 bg-primary text-white h-100 position-relative overflow-hidden">
                    <div class="bg-accent rounded-circle position-absolute blur-3xl opacity-20" style="width: 200px; height: 200px; top: -50px; right: -50px;"></div>
                    
                    <h4 class="fw-bold mb-5 position-relative">Nos Coordonnées</h4>
                    
                    <div class="d-flex gap-4 mb-5 position-relative">
                        <div class="fs-3 opacity-50"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Localisation</h6>
                            <p class="small mb-0 opacity-75">Quartier Bastos, Yaoundé<br>République du Cameroun</p>
                        </div>
                    </div>

                    <div class="d-flex gap-4 mb-5 position-relative">
                        <div class="fs-3 opacity-50"><i class="bi bi-envelope-at"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Email</h6>
                            <p class="small mb-0 opacity-75">contact@mia-cameroun.cm</p>
                        </div>
                    </div>

                    <div class="d-flex gap-4 mb-5 position-relative">
                        <div class="fs-3 opacity-50"><i class="bi bi-phone"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Téléphone</h6>
                            <p class="small mb-0 opacity-75">+237 6XX XXX XXX</p>
                        </div>
                    </div>

                    <hr class="opacity-10 my-4 position-relative">
                    
                    <div class="d-flex gap-3 position-relative">
                        <a href="#" class="btn btn-outline-light rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm" style="width: 36px; height: 36px;"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm" style="width: 36px; height: 36px;"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="btn btn-outline-light rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm" style="width: 36px; height: 36px;"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card-mia border-0 shadow-lg p-5 bg-white h-100">
                    <h4 class="fw-bold mb-4">Envoyez-nous un message</h4>
                    <form id="contactForm">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-slate-700">Nom complet *</label>
                                <input type="text" class="form-control-mia w-100" id="from_name" required placeholder="Votre nom">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-slate-700">Adresse email *</label>
                                <input type="email" class="form-control-mia w-100" id="reply_to" required placeholder="email@exemple.com">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-slate-700">Sujet de votre message</label>
                                <input type="text" class="form-control-mia w-100" placeholder="Ex: Inscription à la data science">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-bold text-slate-700">Votre message *</label>
                                <textarea class="form-control-mia w-100" id="message" rows="6" required placeholder="Comment pouvons-nous vous aider ?"></textarea>
                            </div>
                            <div class="col-12 pt-3">
                                <button type="submit" class="btn btn-accent px-5 py-3 rounded-pill fw-bold shadow-sm w-100 w-md-auto">
                                    Envoyer le message <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="bootstrap-5.3.8/bootstrap-5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
