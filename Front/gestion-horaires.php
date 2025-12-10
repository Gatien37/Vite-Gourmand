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

    <section class="horaires-hero">
        <h1>Gestion des horaires</h1>
        <p>Modifiez les horaires affichés sur le site.</p>
    </section>

    <section class="horaires-form-container">

        <form class="horaires-form" action="#" method="POST">
            <h2>Horaires d'ouverture</h2>
            <div class="jour">
                <label for="lundi">Lundi</label>
                <input type="text" id="lundi" name="lundi" placeholder="Ex : 9h - 18h">
            </div>
            <div class="jour">
                <label for="mardi">Mardi</label>
                <input type="text" id="mardi" name="mardi" placeholder="Ex : 9h - 18h">
            </div>
            <div class="jour">
                <label for="mercredi">Mercredi</label>
                <input type="text" id="mercredi" name="mercredi" placeholder="Ex : 9h - 18h">
            </div>
            <div class="jour">
                <label for="jeudi">Jeudi</label>
                <input type="text" id="jeudi" name="jeudi" placeholder="Ex : 9h - 18h">
            </div>
            <div class="jour">
                <label for="vendredi">Vendredi</label>
                <input type="text" id="vendredi" name="vendredi" placeholder="Ex : 9h - 18h">
            </div>
            <div class="jour">
                <label for="samedi">Samedi</label>
                <input type="text" id="samedi" name="samedi" placeholder="Ex : 10h - 14h">
            </div>
            <div class="jour">
                <label for="dimanche">Dimanche</label>
                <input type="text" id="dimanche" name="dimanche" placeholder="Ex : Fermé">
            </div>
            <button type="submit" class="btn-commande">Enregistrer les horaires</button>
            <div class="auth-links">
                <a href="dashboard-employe.php">← Retour au dashboard</a>
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
                <p>Email : contact@viteetgourmand.fr</p>
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
