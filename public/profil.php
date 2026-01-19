<?php
/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/utilisateurModel.php';

/* ========== Récupération de l’utilisateur ========== */

$userId = (int) $_SESSION['user']['id'];

$user = getUtilisateurById($pdo, $userId);

if (!$user) {
    header('Location: espace-utilisateur.php');
    exit;
}

/* ========== Initialisation des messages ========== */

$success = null;
$error   = null;

/* ========== Traitement du formulaire de mise à jour ========== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $adresse    = trim($_POST['adresse'] ?? '');
    $ville      = trim($_POST['ville'] ?? '');
    $codePostal = trim($_POST['code_postal'] ?? '');

    /* ========== Validation des données ========== */

    if (
        !$adresse ||
        !$ville ||
        !preg_match('/^\d{5}$/', $codePostal)
    ) {

        $error = "Adresse ou code postal invalide.";

    } else {

        /* ========== Mise à jour de l’adresse utilisateur ========== */

        updateAdresseUtilisateur($pdo, $userId, [
            'adresse'     => $adresse,
            'ville'       => $ville,
            'code_postal' => $codePostal
        ]);

        $success = "Adresse mise à jour avec succès.";

        /* ========== Rechargement des données utilisateur ========== */
        $user = getUtilisateurById($pdo, $userId);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Profil utilisateur";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <!-- ===== Titre de la page ===== -->
    <section class="hero-section commandes-hero">
        <h1>Mon profil</h1>
        <p>Modifiez vos informations personnelles.</p>
    </section>

    <section class="profil-container">

        <!-- ===== Formulaire profil utilisateur ===== -->
        <form
            class="profil-form form-card"
            action="#"
            method="POST"
        >

            <!-- Message de succès -->
            <?php if ($success): ?>
                <p class="alert-success"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <!-- Message d’erreur -->
            <?php if ($error): ?>
                <p class="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <!-- Informations non modifiables -->
            <input
                type="text"
                name="prenom"
                value="<?= htmlspecialchars($user['prenom']) ?>"
                disabled
            >

            <input
                type="text"
                name="nom"
                value="<?= htmlspecialchars($user['nom']) ?>"
                disabled
            >

            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($user['email']) ?>"
                disabled
            >

            <input
                type="text"
                name="telephone"
                value="<?= htmlspecialchars($user['gsm']) ?>"
                disabled
            >

            <!-- Informations modifiables -->
            <label for="adresse">Adresse</label>
            <input
                type="text"
                name="adresse"
                value="<?= htmlspecialchars($user['adresse']) ?>"
            >

            <label for="ville">Ville</label>
            <input
                type="text"
                name="ville"
                value="<?= htmlspecialchars($user['ville']) ?>"
            >

            <label for="code-postal">Code postal</label>
            <input
                type="text"
                name="code_postal"
                value="<?= htmlspecialchars($user['code_postal']) ?>"
            >

            <button type="submit" class="btn-commande">
                Enregistrer les modifications
            </button>

            <div class="auth-links">
                <a href="espace-utilisateur.php">
                    Retour à mon tableau de bord
                </a>
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
