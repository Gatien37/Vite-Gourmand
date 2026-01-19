<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../services/passwordService.php';

$message = null;
$success = false;

$token = $_GET['token'] ?? null;
$user = null;

if (!$token) {
    $message = "Lien de réinitialisation invalide.";
} else {
    $user = verifierTokenReset($pdo, $token);

    if (!$user) {
        $message = "Lien de réinitialisation expiré ou invalide.";
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $error = traiterNouveauMotDePasse($pdo, (int)$user['id'], $_POST);

        if ($error) {
            $message = $error;
        } else {
            $success = true;
            $message = "Votre mot de passe a été réinitialisé avec succès.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Nouveau mot de passe";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<!-- Header -->
<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Nouveau mot de passe</h1>
    <p>Saisissez votre nouveau mot de passe ci-dessous.</p>
</section>

<section class="reset-container">

    <?php if (!empty($message)): ?>
        <p class="<?= $success ? 'alert-success' : 'error-message' ?>">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>

    <?php if ($token && $user && !$success): ?>
        <form class="reset-form form-card" action="#" method="POST">

            <label for="password">Nouveau mot de passe</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                placeholder="Votre nouveau mot de passe"
            >

            <label for="confirm-password">Confirmer le mot de passe</label>
            <input
                type="password"
                id="confirm-password"
                name="confirm_password"
                required
                placeholder="Confirmez le mot de passe"
            >

            <button type="submit" class="btn-commande">
                Réinitialiser le mot de passe
            </button>

            <div class="auth-links">
                <a href="connexion.php">Retour à la connexion</a>
            </div>
        </form>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="auth-links">
            <a href="connexion.php" class="btn-commande">
                Se connecter
            </a>
        </div>
    <?php endif; ?>

</section>

<!-- Footer -->
<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
