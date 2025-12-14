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
        <h1>Mes commandes</h1>
        <p>Consultez vos commandes passées et en cours.</p>
    </section>

    <section class="orders-container">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Menu</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <!-- Exemple 1 -->
                <tr>
                    <td>#CMD-1023</td>
                    <td>Menu Festif de Noël</td>
                    <td>24/12/2024</td>
                    <td><span class="status en-cours">En cours</span></td>
                    <td>199,20 €</td>
                    <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                </tr>
                <!-- Exemple 2 -->
                <tr>
                    <td>#CMD-0987</td>
                    <td>Menu Saveurs du Monde</td>
                    <td>10/11/2024</td>
                    <td><span class="status livre">Livrée</span></td>
                    <td>149,40 €</td>
                    <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                </tr>
                <!-- Exemple 3 -->
                <tr>
                    <td>#CMD-0874</td>
                    <td>Menu Cocktail Premium</td>
                    <td>02/10/2024</td>
                    <td><span class="status annulee">Annulée</span></td>
                    <td>0,00 €</td>
                    <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                </tr>
            </tbody>
        </table>
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
