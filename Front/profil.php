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
        <h1>Mon profil</h1>
        <p>Modifiez vos informations personnelles.</p>
    </section>

    <section class="profil-container">
        <form class="profil-form form-card" action="#" method="POST">
            <!-- Informations personnelles -->
            <h2>Informations personnelles</h2>
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.com">
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" placeholder="Votre numéro">

            <!-- Adresse -->
            <h2>Adresse</h2>
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" placeholder="Votre adresse">
            <label for="ville">Ville</label>
            <input type="text" id="ville" name="ville" placeholder="Votre ville">
            <label for="code-postal">Code postal</label>
            <input type="text" id="code-postal" name="code_postal" placeholder="Code postal">

            <!-- Mot de passe -->
            <h2>Modifier mon mot de passe</h2>
            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Nouveau mot de passe">
            <label for="confirm-password">Confirmer le mot de passe</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirmez le mot de passe">
            <button type="submit" class="btn-commande">Enregistrer les modifications</button>
            <div class="auth-links">
                <a href="espace-utilisateur.php">Retour à mon tableau de bord</a>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
