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

    <section class="commandes-hero">
        <h1>Gestion des commandes</h1>
        <p>Consultez et mettez à jour les commandes clients.</p>
    </section>

    <section class="commandes-admin-container">
        <table class="commandes-admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Menu</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Mode</th>
                    <th>Statut</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- COMMANDE EXEMPLE 1 -->
                <tr>
                    <td>#CMD-1023</td>
                    <td>Claire M.</td>
                    <td>Menu Festif de Noël</td>
                    <td>24/12/2024</td>
                    <td>19h30</td>
                    <td>Livraison</td>
                    <td>
                        <select name="statut">
                            <option>En attente</option>
                            <option selected>En cours</option>
                            <option>Livrée</option>
                            <option>Annulée</option>
                        </select>
                    </td>
                    <td>199,20 €</td>
                    <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                </tr>
                <!-- COMMANDE EXEMPLE 2 -->
                <tr>
                    <td>#CMD-1001</td>
                    <td>Julien R.</td>
                    <td>Menu Saveurs du Monde</td>
                    <td>10/12/2024</td>
                    <td>12h00</td>
                    <td>Retrait</td>
                    <td>
                        <select name="statut">
                            <option selected>En attente</option>
                            <option>En cours</option>
                            <option>Livrée</option>
                            <option>Annulée</option>
                        </select>
                    </td>

                    <td>149,40 €</td>
                    <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                </tr>
                <!-- COMMANDE EXEMPLE 3 -->
                <tr>
                    <td>#CMD-0987</td>
                    <td>Sophie L.</td>
                    <td>Menu Cocktail Premium</td>
                    <td>02/11/2024</td>
                    <td>18h00</td>
                    <td>Livraison</td>

                    <td>
                        <select name="statut">
                            <option>En attente</option>
                            <option>En cours</option>
                            <option selected>Livrée</option>
                            <option>Annulée</option>
                        </select>
                    </td>
                    <td>179,90 €</td>
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
