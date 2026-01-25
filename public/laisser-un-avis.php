<?php
/* ========== Génération du token CSRF ========== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';
require_once __DIR__ . '/../models/avisModel.php';
require_once __DIR__ . '/../services/avisService.php';

/* ========== Sécurité : paramètre commande valide ========== */
if (!isset($_GET['commande_id']) || !is_numeric($_GET['commande_id'])) {
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Initialisation des identifiants ========== */
$userId     = (int) $_SESSION['user']['id'];
$commandeId = (int) $_GET['commande_id'];

/* ========== Vérification de l’éligibilité à déposer un avis ========== */
$result = verifierEligibiliteAvis($pdo, $commandeId, $userId);

if (!empty($result['error'])) {
    $_SESSION['error'] = $result['error'];
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Données de la commande ========== */
$commande = $result['commande'];

/* ========== Traitement du formulaire d’avis ========== */
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ===== Vérification CSRF ===== */
    if (
        empty($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        http_response_code(403);
        exit('Action non autorisée (CSRF).');
    }

    $error = traiterDepotAvis($pdo, $commandeId, $_POST);

    if (!$error) {
        $_SESSION['success'] = "Merci pour votre avis. Il sera publié après validation.";

        /* Sécurité : invalider le token après succès */
        unset($_SESSION['csrf_token']);

        header('Location: commande-utilisateur.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Laisser un avis";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <!-- ===== Titre ===== -->
    <section class="hero-section commandes-hero">
        <h1>Laisser un avis</h1>
        <p>Partagez votre expérience avec Vite & Gourmand.</p>
    </section>

    <section class="avis-page-container">

        <!-- ===== Formulaire d’avis ===== -->
        <form class="avis-form form-card" method="POST">

            <!-- CSRF -->
            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
            >

            <!-- Message d’erreur -->
            <?php if ($error): ?>
                <p class="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <h2>Votre commande</h2>

            <p>
                <strong>Menu :</strong>
                <?= htmlspecialchars($commande['menu_nom']) ?>
            </p>

            <p>
                <strong>Commande :</strong>
                #CMD-<?= (int) $commande['id'] ?>
            </p>

            <h2>Votre note</h2>

            <!-- Système de notation -->
            <div class="rating" id="rating">

                <input type="hidden" name="note" id="note" value="0">

                <span class="star" data-value="1">★</span>
                <span class="star" data-value="2">★</span>
                <span class="star" data-value="3">★</span>
                <span class="star" data-value="4">★</span>
                <span class="star" data-value="5">★</span>
            </div>

            <h2>Votre commentaire</h2>

            <textarea
                name="commentaire"
                rows="5"
                placeholder="Donnez votre avis sur le menu, la livraison, la qualité des plats…"
            ></textarea>

            <button type="submit" class="btn-commande">
                Envoyer mon avis
            </button>

            <div class="auth-links">
                <a href="commande-utilisateur.php">← Retour à mes commandes</a>
            </div>

        </form>
    </section>
</main>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
