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
        <h1>Statistiques générales</h1>
        <p>Analysez les performances de Vite & Gourmand.</p>
    </section>

    <section class="stats-summary">
        <div class="stats-card">
            <h2>📦 Commandes totales</h2>
            <p class="stats-value">1245</p>
        </div>
        <div class="stats-card">
            <h2>💶 Chiffre d'affaires total</h2>
            <p class="stats-value">48 320 €</p>
        </div>
        <div class="stats-card">
            <h2>🍽️ Menu le plus vendu</h2>
            <p class="stats-value">Menu Festif de Noël</p>
        </div>
        <div class="stats-card">
            <h2>⭐ Note moyenne clients</h2>
            <p class="stats-value">4.6 / 5</p>
        </div>
    </section>

    <section class="stats-graphs">
        <div class="graph-card">
            <h2>Évolution des ventes</h2>
            <canvas id="graphVentes"></canvas>
        </div>
        <div class="graph-card">
            <h2>Menus les plus populaires</h2>
            <canvas id="graphMenus"></canvas>
        </div>
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
                <p>Email : contact@viteetgourmand.fr</p>
            </div>

            <div class="legal">
                <a href="mentions-legales.php">Mentions légales</a>
                <a href="cgv.php">Conditions Générales de Vente</a>
            </div>

            <div class="copyright">
                <p>&copy; 2024 Vite & Gourmand. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>
