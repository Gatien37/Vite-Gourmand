<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace employé - Vite & Gourmand</title>
</head>

<body>

    <header>
        <div class="header-container">
            <img src="assets/images/logo.png" alt="logo Vite & Gourmand">
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="menus.php">Menu</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="buttons">
                <button>Déconnexion</button>
            </div>
        </div>
    </header>

    <section class="employe-hero">
        <h1>Tableau de bord employé</h1>
        <p>Gérez les menus, commandes, avis et horaires.</p>
    </section>

    <section class="employe-dashboard-container">
        <!-- GESTION DES MENUS -->
        <div class="dashboard-card">
            <h2>📋 Menus</h2>
            <p>Créer, modifier ou supprimer les menus proposés.</p>
            <a href="gestion-menus.php" class="btn-commande">Gérer les menus</a>
        </div>
        <!-- GESTION DES COMMANDES -->
        <div class="dashboard-card">
            <h2>📦 Commandes</h2>
            <p>Consultez et mettez à jour les commandes des clients.</p>
            <a href="gestion-commandes.php" class="btn-commande">Gérer les commandes</a>
        </div>
        <!-- GESTION DES AVIS -->
        <div class="dashboard-card">
            <h2>⭐ Avis</h2>
            <p>Validez, refusez ou modérez les avis clients.</p>
            <a href="gestion-avis.php" class="btn-commande">Gérer les avis</a>
        </div>
        <!-- GESTION DES HORAIRES -->
        <div class="dashboard-card">
            <h2>🕒 Horaires</h2>
            <p>Modifier les horaires d'ouverture affichés sur le site.</p>
            <a href="gestion-horaires.php" class="btn-commande">Modifier les horaires</a>
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
