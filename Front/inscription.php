<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Vite & Gourmand</title>
</head>


<body>

    <header>
        <div class="header-container">
            <img src="assets/images/logo.svg" alt="logo Vite & Gourmand">
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="menus.php">Menu</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="buttons">
                <a href="connexion.php" class="connect-button">Se connecter</a>
                <a href="inscription.php" class="signup-button">Créer un compte</a>
            </div>
        </div>
    </header>

    <section class="hero-section commandes-hero">
        <h1>Créer un compte</h1>
        <p>Rejoignez Vite & Gourmand et commandez vos menus en quelques clics !</p>
    </section>

    <section class="register-container">
        <form class="register-form form-card" action="#" method="POST">

            <h2>Informations personnelles</h2>
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom">
            <label for="email">Adresse e-mail</label>
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
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe">
            <label for="confirm-password">Confirmer le mot de passe</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirmez le mot de passe">
            <button type="submit" class="btn-commande">Créer mon compte</button>

            <div class="auth-links">
                <a href="connexion.php">Déjà un compte ? Se connecter</a>
            </div>
        </form>
    </section>
    <footer>
        <div class="footer-container">
            <div class="horaires">
                <h3>Horaires</h3>
                <p>Lundi - Vendredi : 9h - 18h</p>
                <p>Samedi : 10h - 14h</p>
                <p>Dimanche : Fermé</p>
            </div>
            <div class="contact">
                <p>Vite & Gourmand, 12 Rue des Gourmets, 33000 Bordeaux</p>
                <p>Téléphone : 05 56 48 32 10</p>
                <p>Email : contact@viteetgourmand.fr </p>
            </div>
            <div class="legal">
                <a href="mentions-legales.php">Mentions légales</a>
                <a href="cgv.php">Conditions Générales de Vente</a>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Vite & Gourmand. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>