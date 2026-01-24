<?php
/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';

/* ========== Initialisation explicite de la session ========== */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ========== Génération du token CSRF ========== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/utilisateurModel.php';

/* ========== Récupération de l’utilisateur ========== */
$userId = (int) $_SESSION['user']['id'];
$user   = getUtilisateurById($pdo, $userId);

if (!$user) {
    header('Location: espace-utilisateur.php');
    exit;
}

/* ========== Initialisation des messages ========== */
$success = null;
$error   = null;

/* ========== Traitement du formulaire de mise à jour ========== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ===== Vérification CSRF ===== */
    if (
        empty($_POST['csrf_token']) ||
        empty($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        http_response_code(403);
        exit('Action non autorisée (CSRF).');
    }

    $adresse    = trim($_POST['adresse'] ?? '');
    $ville      = trim($_POST['ville'] ?? '');
    $codePostal = trim($_POST['code_postal'] ?? '');

    /* ===== Validation des données ===== */
    if (
        !$adresse ||
        !$ville ||
        !preg_match('/^\d{5}$/', $codePostal)
    ) {
        $error = "Adresse ou code postal invalide.";
    } else {

        /* ===== Mise à jour de l’adresse ===== */
        updateAdresseUtilisateur($pdo, $userId, [
            'adresse'     => $adresse,
            'ville'       => $ville,
            'code_postal' => $codePostal
        ]);

        $success = "Adresse mise à jour avec succès.";

        /* ===== Rechargement utilisateur ===== */
        $user = getUtilisateurById($pdo, $userId);

        /* ===== Invalidation du token CSRF ===== */
        unset($_SESSION['csrf_token']);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Profil utilisateur";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main id="main-content">

    <section class="hero-section commandes-hero">
        <h1>Mon profil</h1>
        <p>Modifiez vos informations personnelles.</p>
    </section>

    <section class="profil-container">

        <form class="profil-form form-card" method="POST">

            <!-- CSRF -->
            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
            >

            <?php if ($success): ?>
                <p class="alert-success"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <?php if ($error): ?>
                <p class="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <!-- Champs non modifiables -->
            <input type="text" value="<?= htmlspecialchars($user['prenom']) ?>" disabled>
            <input type="text" value="<?= htmlspecialchars($user['nom']) ?>" disabled>
            <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
            <input type="text" value="<?= htmlspecialchars($user['gsm']) ?>" disabled>

            <!-- Champs modifiables -->
            <label>Adresse</label>
            <input type="text" name="adresse" value="<?= htmlspecialchars($user['adresse']) ?>">

            <label>Ville</label>
            <input type="text" name="ville" value="<?= htmlspecialchars($user['ville']) ?>">

            <label>Code postal</label>
            <input type="text" name="code_postal" value="<?= htmlspecialchars($user['code_postal']) ?>">

            <button type="submit" class="btn-commande">
                Enregistrer les modifications
            </button>

            <div class="auth-links">
                <a href="espace-utilisateur.php">Retour à mon tableau de bord</a>
            </div>

        </form>
    </section>

</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
