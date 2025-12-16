<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Accueil";
    require_once __DIR__ . '/partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1>Nouveau mot de passe</h1>
        <p>Saisissez votre nouveau mot de passe ci-dessous.</p>
    </section>

    <section class="reset-container">
        <form class="reset-form form-card" action="#" method="POST">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Votre nouveau mot de passe">
            <label for="confirm-password">Confirmer le mot de passe</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirmez le mot de passe">
            <button type="submit" class="btn-commande">Réinitialiser le mot de passe</button>
            <div class="auth-links">
                <a href="connexion.php">Retour à la connexion</a>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>