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
        <h1>Gestion des menus</h1>
        <p>Ajoutez, modifiez ou supprimez les menus disponibles.</p>
    </section>

        <!-- Bouton ajouter -->
        <div class="add-menu-container">
            <a href="form-menu.php" class="btn-commande"> Ajouter un menu</a>
        </div>
    <section class="menus-admin-container">
        <!-- Tableau des menus -->
        <table class="menus-admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du menu</th>
                    <th>Prix / pers.</th>
                    <th>Thème</th>
                    <th>Régime</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemple 1 -->
                <tr>
                    <td>1</td>
                    <td>Menu Festif de Noël</td>
                    <td>24,90 €</td>
                    <td>Noël</td>
                    <td>Classique</td>
                    <td>
                        <a href="form-menu.php?id=1" class="btn-commande">Modifier</a>
                        <a href="#" class="btn-secondary">Supprimer</a>
                    </td>
                </tr>
                <!-- Exemple 2 -->
                <tr>
                    <td>2</td>
                    <td>Menu Vegan Savoureux</td>
                    <td>19,90 €</td>
                    <td>Vegan</td>
                    <td>Végétalien</td>
                    <td>
                        <a href="form-menu.php?id=2" class="btn-commande">Modifier</a>
                        <a href="#" class="btn-secondary">Supprimer</a>
                    </td>
                </tr>
                <!-- Exemple 3 -->
                <tr>
                    <td>3</td>
                    <td>Menu Saveurs du Monde</td>
                    <td>22,50 €</td>
                    <td>International</td>
                    <td>Classique</td>
                    <td>
                        <a href="form-menu.php?id=3" class="btn-commande">Modifier</a>
                        <a href="#" class="btn-secondary">Supprimer</a>
                    </td>
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
