<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../services/passwordService.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    traiterDemandeReinitialisation($pdo, $email);

    $message = "Si un compte existe avec cette adresse, un e-mail a été envoyé.";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Mot de passe oublié";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <section class="hero-section commandes-hero">

        <h1>Mot de passe oublié</h1>
        <p>Entrez votre adresse e-mail pour recevoir un lien de réinitialisation.</p>
    </section>

    <section class="forgot-container">
        <form class="forgot-form form-card" action="#" method="POST">

            <?php if (!empty($message)): ?>
                <p class="alert-success"><?= htmlspecialchars($message) ?></p>

            <?php endif; ?>

            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" required placeholder="exemple@mail.com">
            <button type="submit" class="btn-commande">Réinitialiser le mot de passe</button>
            <div class="auth-links">
                <a href="connexion.php">Retour à la connexion</a>
                <a href="inscription.php">Créer un compte</a>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>