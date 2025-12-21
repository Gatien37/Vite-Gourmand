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
        <h1>Créer un compte</h1>
        <p>Rejoignez Vite & Gourmand et commandez vos menus en quelques clics !</p>
    </section>

    <section class="register-container">
        <form id="register-form" class="register-form form-card" action="#" method="POST">

            <h2>Informations personnelles</h2>
            <label for="prenom">Prénom <span class="required">*</span></label>
            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom">
            <label for="nom">Nom <span class="required">*</span></label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom">
            <label for="email">Adresse e-mail <span class="required">*</span></label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.com">
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" placeholder="Votre numéro de téléphone">

            <h2>Adresse de livraison</h2>
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" placeholder="Votre adresse">
            <label for="ville">Ville</label>
            <input type="text" id="ville" name="ville" placeholder="Votre ville">
            <label for="code-postal">Code postal</label>
            <input type="text" id="code-postal" name="code_postal" placeholder="Code postal">

            <h2>Sécurité du compte</h2>
            <label for="password">Mot de passe <span class="required">*</span></label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe">
            <label for="confirm-password">Confirmer le mot de passe <span class="required">*</span></label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirmez le mot de passe">
            <button type="submit" class="btn-commande">Créer mon compte</button>

            <div class="auth-links">
                <p class="required-info">
                <span class="required">*</span> Champs obligatoires
                </p>
                <p id="form-error"></p>
                <a href="connexion.php">Déjà un compte ? Se connecter</a>
            </div>
        </form>
    </section>
    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>