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
        <h1>Connexion</h1>
        <p>Accédez à votre espace personnel.</p>
    </section>

    <section class="login-container">
        <form class="login-form form-card" action="#" method="POST">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.com" required>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe">
            <button type="submit" class="btn-commande">Se connecter</button>
            <div class="auth-links">
                <a href="mot-de-passe-oublie.php">Mot de passe oublié ?</a>
                <a href="inscription.php">Créer un compte</a>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>