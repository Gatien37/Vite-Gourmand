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

    <section class="hero-menus">
            <h1>Tous nos menus</h1>
            <p>Trouvez facilement le menu adapté à votre événement.</p>
    </section>

    <section class="filtres">
        <div class="filtre-icone">
            <button class="filtre-btn">Prix maximum</button>
            <img src="assets/images/icone_fleche_bas.svg" alt="flèche bas">
        </div>
        <div class="filtre-icone">
            <button class="filtre-btn">Fourchette de prix</button>
            <img src="assets/images/icone_fleche_bas.svg" alt="flèche bas">
        </div>
        <div class="filtre-icone">
            <button class="filtre-btn">Thème</button>
            <img src="assets/images/icone_fleche_bas.svg" alt="flèche bas">
        </div>
        <div class="filtre-icone">
            <button class="filtre-btn">Régime</button>
            <img src="assets/images/icone_fleche_bas.svg" alt="flèche bas">
        </div>
        <div class="filtre-icone">
            <button class="filtre-btn">Nombre de personnes minimum</button>
            <img src="assets/images/icone_fleche_bas.svg" alt="flèche bas">
        </div>
            <button class="filtre-appliquer">Appliquer</button>
        </div>
    </section>
    
    <section class="menus-list">
        <div class="menu-item">
            <img src="assets/images/menu-vegan.jpg" alt="Plat du menu vegan">
            <h2>Menu Vegan Savoureux</h2>
            <p>Un menu 100 % vegan, coloré et savoureux, préparé avec des ingrédients frais et de saison. </p>
            <p>Minimum : 4 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
        <div class="menu-item">
            <img src="assets/images/menu-noel.jpg" alt="Menu de noel">
            <h2>Menu Festif de Noel</h2>
            <p>Des plats chaleureux et raffinés pour un repas de Noël réussi.</p>
            <p>Minimum : 4 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
        <div class="menu-item">
            <img src="assets/images/menu-vegetarien.jpg" alt="Menu végétarien">
            <h2>Menu Gourmand Végétarien</h2>
            <p>Un menu coloré et savoureux, 100 % végétarien et riche en goût.</p>
            <p>Minimum : 4 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
        <div class="menu-item">
            <img src="assets/images/menu-anniversaire.jpg" alt="Menu anniversaire">
            <h2>Menu Anniversaire Enfant</h2>
            <p>Un menu joyeux, simple et savoureux, parfait pour les anniversaires d'enfants.</p>
            <p>Minimum : 8 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
        <div class="menu-item">
            <img src="assets/images/menu-cocktail.jpg" alt="Menu cocktail">
            <h2>Menu Cocktail Premium</h2>
            <p>Un menu raffiné pour vos apéritifs d'entreprise ou cocktails dinatoires.</p>
            <p>Minimum : 10 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
        <div class="menu-item">
            <img src="assets/images/menu-monde.jpg" alt="Menu monde">
            <h2>Menu Saveurs du Monde</h2>
            <p>Un voyage culinaire à travers plusieurs inspirations du monde.</p>
            <p>Minimum : 6 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
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