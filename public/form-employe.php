<?php
/* ========== Sécurité : accès administrateur ========== */
require_once __DIR__ . '/../middlewares/requireAdmin.php';

/* ========== Génération du token CSRF ========== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../services/employeService.php';

/* ========== Initialisation des erreurs ========== */
$error = null;

/* ========== Traitement du formulaire de création employé ========== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ===== Vérification CSRF ===== */
    if (
        empty($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        http_response_code(403);
        exit('Action non autorisée (CSRF).');
    }

    $result = creerEmploye($pdo, $_POST);

    if (!empty($result['error'])) {
        $error = $result['error'];
    }
    elseif (!empty($result['success'])) {
        header('Location: gestion-employes.php');
        exit;
    }
    else {
        $error = "Erreur inattendue lors de la création de l'employé.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Créer employé";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main id="main-content">

    <!-- ===== Titre ===== -->
    <section class="hero-section commandes-hero">
        <h1>Créer un employé</h1>
        <p>Création d'un compte employé.</p>
    </section>

    <section class="employe-form-container">

        <!-- ===== Formulaire de création employé ===== -->
        <form method="POST" class="employe-form form-card">

            <!-- CSRF -->
            <input
                type="hidden"
                name="csrf_token"
                value="<?= $_SESSION['csrf_token'] ?>"
            >

            <!-- Message d’erreur -->
            <?php if ($error): ?>
                <p class="alert-error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <label for="email">Email *</label>
            <input
                type="email"
                id="email"
                name="email"
                required
            >

            <label for="password">Mot de passe *</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >

            <label for="confirm_password">Confirmer le mot de passe *</label>
            <input
                type="password"
                id="confirm_password"
                name="confirm_password"
                required
            >

            <button type="submit" class="btn-commande">
                Créer l'employé
            </button>

            <div class="auth-links">
                <a href="gestion-employes.php">← Retour</a>
            </div>

        </form>
    </section>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
