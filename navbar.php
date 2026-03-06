<?php
require_once 'auth.php';
$user = get_user();
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Navbar SaaS -->
<nav class="navbar navbar-expand-lg fixed-top navbar-mia">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img src="logo.jpeg" alt="Logo MIA-Cameroun" class="navbar-brand-logo">
            <div class="d-none d-sm-block">
                <span class="brand-name d-block">MIA-Cameroun</span>
                <span class="brand-sub d-block">Maison de l'IA</span>
            </div>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto gap-2 align-items-center">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'index.php' ? 'active' : '' ?>" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'a-propos.php' ? 'active' : '' ?>" href="a-propos.php">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'programmes.php' ? 'active' : '' ?>" href="programmes.php">Programmes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_page == 'contact.php' ? 'active' : '' ?>" href="contact.php">Contact</a>
                </li>
                
                <?php if (is_logged_in()): ?>
                    <li class="nav-item ms-lg-3">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-3 bg-slate-50 rounded-pill px-3 shadow-sm border" href="#" role="button" data-bs-toggle="dropdown">
                                <span class="small d-none d-md-inline"><strong><?= htmlspecialchars($user['username']) ?></strong></span>
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 32px; height: 32px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border mt-2 p-2" style="border-radius: 12px; min-width: 200px;">
                                <div class="px-3 py-2 border-bottom mb-2 d-md-none">
                                    <span class="small text-muted d-block">Connecté en tant que</span>
                                    <strong><?= htmlspecialchars($user['username']) ?></strong>
                                </div>
                                <li><a class="dropdown-item py-2" href="mes-formations.php"><i class="bi bi-mortarboard me-2"></i>Mes Formations</a></li>
                                <?php if (is_admin()): ?>
                                    <li><a class="dropdown-item py-2 text-primary" href="admin.php"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</a></li>
                            </ul>
                        </div>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-lg-2">
                        <a class="nav-link px-3" href="login.php" style="font-weight: 500;">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-accent rounded-pill px-4" href="register.php">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
