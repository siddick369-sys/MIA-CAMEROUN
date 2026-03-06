<?php
require_once 'config.php';
require_once 'auth.php';

// Sécurité : Uniquement pour les admins
require_admin();

$msg = '';
$action = $_GET['action'] ?? 'list';
$edit_id = $_GET['edit'] ?? null;

// Gérer les actions (Ajouter, Modifier, Supprimer)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $categorie = $_POST['categorie'];
    $duree = $_POST['duree'];
    $format = $_POST['format'];

    if (isset($_POST['add'])) {
        $stmt = $pdo->prepare("INSERT INTO programmes (titre, description, type, categorie, duree, format) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$titre, $description, $type, $categorie, $duree, $format]);
        $msg = "Programme ajouté avec succès !";
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE programmes SET titre=?, description=?, type=?, categorie=?, duree=?, format=? WHERE id=?");
        $stmt->execute([$titre, $description, $type, $categorie, $duree, $format, $id]);
        $msg = "Programme mis à jour !";
        $action = 'list';
    }
}

if ($action === 'delete' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM programmes WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: admin.php?msg=deleted");
    exit();
}

// Récupérer les données pour l'édition
$edit_prog = null;
if ($edit_id) {
    $stmt = $pdo->prepare("SELECT * FROM programmes WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_prog = $stmt->fetch();
    $action = 'form';
}

// Récupérer tous les programmes et le nombre d'inscrits
$stmt = $pdo->query("SELECT p.*, (SELECT COUNT(*) FROM inscriptions WHERE programme_id = p.id) as total_inscrits FROM programmes p ORDER BY p.date_pub DESC");
$programmes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIA Admin | Gestion des Programmes</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .sidebar { background: white; border-right: 1px solid var(--mia-slate-100); min-height: calc(100vh - 80px); }
        .nav-admin-link { padding: 12px 20px; border-radius: 8px; color: var(--mia-slate-700); margin-bottom: 5px; font-weight: 500; }
        .nav-admin-link:hover, .nav-admin-link.active { background: var(--mia-slate-50); color: var(--mia-accent); }
    </style>
</head>
<body class="bg-light">

    <?php include 'navbar.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 sidebar d-none d-lg-block p-4">
                <div class="small text-uppercase fw-bold text-muted mb-4 letter-spacing-1">Menu Principal</div>
                <nav class="nav flex-column">
                    <a href="admin.php" class="nav-admin-link <?= $action == 'list' ? 'active' : '' ?>"><i class="bi bi-grid-fill me-2"></i> Dashboard</a>
                    <a href="admin.php?action=form" class="nav-admin-link <?= $action == 'form' ? 'active' : '' ?>"><i class="bi bi-plus-circle-fill me-2"></i> Nouveau Programme</a>
                    <a href="programmes.php" class="nav-admin-link"><i class="bi bi-eye-fill me-2"></i> Voir le site</a>
                </nav>
            </div>

            <!-- Content Area -->
            <div class="col-lg-10 p-4 p-md-5">
                
                <?php if (isset($_GET['msg']) || $msg): ?>
                    <div class="alert alert-success border-0 rounded-3 shadow-sm py-3 px-4 mb-4">
                        <i class="bi bi-check-circle-fill me-2"></i> <?= htmlspecialchars($msg ?: "Opération réussie.") ?>
                    </div>
                <?php endif; ?>

                <?php if ($action === 'list'): ?>
                    <div class="d-flex justify-content-between align-items-end mb-5">
                        <div>
                            <span class="section-tag mb-2">Espace Administration</span>
                            <h1 class="fw-bold mb-0">Gestion des Programmes</h1>
                        </div>
                        <a href="admin.php?action=form" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm"><i class="bi bi-plus-lg me-2"></i> Ajouter</a>
                    </div>

                    <div class="card-mia p-0 border-0 shadow-sm overflow-hidden bg-white">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-4 py-3 border-0 small text-uppercase text-muted">Programme</th>
                                    <th class="px-4 py-3 border-0 small text-uppercase text-muted">Type</th>
                                    <th class="px-4 py-3 border-0 small text-uppercase text-muted">Inscrits</th>
                                    <th class="px-4 py-3 border-0 small text-uppercase text-muted text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($programmes as $prog): ?>
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="fw-bold fs-6"><?= htmlspecialchars($prog['titre']) ?></div>
                                        <div class="small text-muted"><?= htmlspecialchars($prog['categorie']) ?></div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="badge rounded-pill bg-slate-100 text-slate-800 px-3 py-2 border small">
                                            <?= htmlspecialchars($prog['type']) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-people text-accent"></i>
                                            <span class="fw-bold"><?= $prog['total_inscrits'] ?></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm rounded-circle border p-0" style="width: 32px; height: 32px;" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border p-2">
                                                <li><a class="dropdown-item py-2" href="admin.php?edit=<?= $prog['id'] ?>"><i class="bi bi-pencil me-2"></i> Modifier</a></li>
                                                <li><a class="dropdown-item py-2 text-danger" href="admin.php?action=delete&id=<?= $prog['id'] ?>" onclick="return confirm('Confirmer la suppression ?')"><i class="bi bi-trash me-2"></i> Supprimer</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php elseif ($action === 'form'): ?>
                    <div class="mb-5">
                        <a href="admin.php" class="text-muted small mb-3 d-inline-block text-decoration-none"><i class="bi bi-arrow-left me-1"></i> Retour à la liste</a>
                        <h2 class="fw-bold"><?= $edit_prog ? 'Modifier' : 'Ajouter' ?> un programme</h2>
                    </div>

                    <div class="card-mia p-5 border-0 shadow-sm bg-white" style="max-width: 800px;">
                        <form method="POST">
                            <?php if ($edit_prog): ?><input type="hidden" name="id" value="<?= $edit_prog['id'] ?>"><?php endif; ?>
                            
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold">Titre du programme</label>
                                    <input type="text" name="titre" class="form-control-mia w-100" value="<?= $edit_prog['titre'] ?? '' ?>" required placeholder="Ex: Masterclass sur l'IA">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Type</label>
                                    <select name="type" class="form-control-mia w-100" required>
                                        <option value="Formation" <?= ($edit_prog['type'] ?? '') == 'Formation' ? 'selected' : '' ?>>Formation</option>
                                        <option value="Atelier" <?= ($edit_prog['type'] ?? '') == 'Atelier' ? 'selected' : '' ?>>Atelier</option>
                                        <option value="Événement" <?= ($edit_prog['type'] ?? '') == 'Événement' ? 'selected' : '' ?>>Événement</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Catégorie</label>
                                    <input type="text" name="categorie" class="form-control-mia w-100" value="<?= $edit_prog['categorie'] ?? '' ?>" placeholder="Ex: Avancé">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Durée</label>
                                    <input type="text" name="duree" class="form-control-mia w-100" value="<?= $edit_prog['duree'] ?? '' ?>" placeholder="Ex: 10 semaines">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Format</label>
                                    <input type="text" name="format" class="form-control-mia w-100" value="<?= $edit_prog['format'] ?? '' ?>" placeholder="Ex: En ligne">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold">Description</label>
                                    <textarea name="description" class="form-control-mia w-100" rows="5" required placeholder="Détaillez le contenu du programme..."><?= $edit_prog['description'] ?? '' ?></textarea>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <button type="submit" name="<?= $edit_prog ? 'update' : 'add' ?>" class="btn btn-primary px-5 py-3 rounded-pill fw-bold shadow-sm">
                                        <?= $edit_prog ? 'Enregistrer les modifications' : 'Créer le programme' ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="bootstrap-5.3.8/bootstrap-5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
