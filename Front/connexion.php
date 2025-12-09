<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion -  Vite & Gourmand</title>
</head>
<body>
    <header>
        <div class="header-container">
            <img src="assets/images/logo.png" alt="logo Vite & Gourmand">
            <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="menus.php">Menu</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            </nav>
            <div class="buttons">
                <button>Se connecter</button>
                <button>Créer un compte</button>
            </div>
        </div>
    </header>
    
    <section class="login-hero">
        <h1>Connexion</h1>
        <p>Accédez à votre espace personnel.</p>
    </section>

    <section class="login-container">
        <form class="login-form" action="#" method="POST">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.com">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe">
            <button type="submit" class="btn-commande">Se connecter</button>
            <div class="auth-links">
                <a href="mot-de-passe-oublie.php">Mot de passe oublié ?</a>
                <a href="inscription.php">Créer un compte</a>
            </div>
        </form>
    </section>

    <footer>
        <div class="footer-container">
            <div class="horaires">
                <h3>Horaires d'ouverture</h3>
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
                <a href="#">Mentions légales</a>
                <a href="#">Conditions Générales de Vente</a>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Vite & Gourmand. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>