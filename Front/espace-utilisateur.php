<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace utilisateur - Vite & Gourmand</title>
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

    <section class="user-hero">
        <h1>Bienvenue dans votre espace</h1>
        <p>Gérez vos informations, vos commandes et vos avis.</p>
    </section>

    <section class="dashboard-container">

        <!-- BLOC PROFIL -->
        <div class="dashboard-card">
            <h2>Mes informations</h2>
            <p>Consultez ou modifiez vos données personnelles.</p>
            <a href="profil.php" class="btn-commande">Voir mon profil</a>
        </div>

        <!-- BLOC COMMANDES -->
        <div class="dashboard-card">
            <h2>Mes commandes</h2>
            <p>Suivez vos commandes passées et en cours.</p>
            <a href="commandes-utilisateur.php" class="btn-commande">Voir mes commandes</a>
        </div>

        <!-- BLOC AVIS -->
        <div class="dashboard-card">
            <h2>Mes avis</h2>
            <p>Retrouvez vos avis déposés et ajoutez-en de nouveaux.</p>
            <a href="laisser-avis.php" class="btn-commande">Gérer mes avis</a>
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
