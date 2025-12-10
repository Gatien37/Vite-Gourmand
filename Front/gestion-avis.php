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

    <section class="avis-hero">
        <h1>Gestion des avis</h1>
        <p>Validez ou refusez les avis déposés par les clients.</p>
    </section>

    <section class="avis-admin-container">
        <table class="avis-admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Menu</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- AVIS EXEMPLE 1 -->
                <tr>
                    <td>#AV-452</td>
                    <td>Claire M.</td>
                    <td>Menu Festif de Noël</td>
                    <td>⭐⭐⭐⭐⭐</td>
                    <td>“Menu délicieux, tout était parfait !”</td>
                    <td>25/12/2024</td>
                    <td><span class="status attente">En attente</span></td>
                    <td>
                        <a href="#" class="btn-commande">Valider</a>
                        <a href="#" class="btn-secondary">Refuser</a>
                    </td>
                </tr>
                <!-- AVIS EXEMPLE 2 -->
                <tr>
                    <td>#AV-447</td>
                    <td>Julien R.</td>
                    <td>Menu Saveurs du Monde</td>
                    <td>⭐⭐⭐⭐</td>
                    <td>“Très bon mais un peu trop épicé.”</td>
                    <td>12/12/2024</td>
                    <td><span class="status valide">Validé</span></td>
                    <td>
                        <a href="#" class="btn-secondary">Refuser</a>
                    </td>
                </tr>
                <!-- AVIS EXEMPLE 3 -->
                <tr>
                    <td>#AV-430</td>
                    <td>Sophie L.</td>
                    <td>Menu Cocktail Premium</td>
                    <td>⭐⭐⭐⭐⭐</td>
                    <td>“Excellent, je recommande !”</td>
                    <td>05/12/2024</td>
                    <td><span class="status refuse">Refusé</span></td>
                    <td>
                        <a href="#" class="btn-commande">Valider</a>
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
