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
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <div class="buttons">
                <button class="connect-button">Se connecter</button>
                <button class="signup-button">Créer un compte</button>
            </div>
        </div>
    </header>

    <section class="admin-hero">
        <h1>Espace Administrateur</h1>
        <p>Pilotez l'activité globale de Vite & Gourmand.</p>
    </section>

    <section class="admin-dashboard-container">
        <!-- GESTION EMPLOYÉS -->
        <div class="dashboard-card">
            <h2>👥 Gestion des employés</h2>
            <p>Ajoutez, modifiez ou supprimez des comptes employés.</p>
            <a href="gestion-employes.php" class="btn-commande">Gérer les employés</a>
        </div>
        <!-- STATISTIQUES -->
        <div class="dashboard-card">
            <h2>📊 Statistiques</h2>
            <p>Visualisez les performances : ventes, menus populaires, avis…</p>
            <a href="statistiques.php" class="btn-commande">Voir les statistiques</a>
        </div>
        <!-- CHIFFRE D'AFFAIRES -->
        <div class="dashboard-card">
            <h2>💰 Chiffre d'affaires</h2>
            <p>Consultez les revenus et filtrez par période ou par menu.</p>
            <a href="chiffre-affaires.php" class="btn-commande">Voir le CA</a>
        </div>
        <!-- ACCÈS AUX FONCTIONS EMPLOYÉ  -->
        <div class="dashboard-card">
            <h2>📋 Menus</h2>
            <p>Accédez à la gestion des menus.</p>
            <a href="gestion-menus.php" class="btn-secondary">Gestion des menus</a>
        </div>
        <div class="dashboard-card">
            <h2>📦 Commandes</h2>
            <p>Suivez et modifiez l'état des commandes en cours.</p>
            <a href="gestion-commandes.php" class="btn-secondary">Gestion des commandes</a>
        </div>
        <div class="dashboard-card">
            <h2>⭐ Avis</h2>
            <p>Validez ou refusez les avis laissés par les clients.</p>
            <a href="gestion-avis.php" class="btn-secondary">Gestion des avis</a>
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
