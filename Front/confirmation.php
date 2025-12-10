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

    <section class="confirmation-hero">
        <h1>🎉 Commande confirmée !</h1>
        <p>Merci pour votre confiance. Votre commande a bien été enregistrée.</p>
    </section>

    <section class="confirmation-container">
        <div class="confirmation-card">
            <h2>Récapitulatif</h2>
            <p><strong>Menu :</strong> Menu Festif de Noël</p>
            <p><strong>Nombre de personnes :</strong> 8</p>
            <p><strong>Date :</strong> 24 décembre 2024</p>
            <p><strong>Heure :</strong> 19h30</p>
            <p><strong>Mode de réception :</strong> Livraison</p>
            <p><strong>Adresse :</strong> 25 Rue des Lilas, 33000 Bordeaux</p>
            <p><strong>Total :</strong> 199,20 €</p>

            <p class="confirmation-message">
                Un e-mail de confirmation vient de vous être envoyé.<br>
                Vous pourrez suivre l'avancée de votre commande dans votre espace client.
            </p>
            <a class="btn-commande" href="espace-utilisateur.php">Voir mes commandes</a>
            <a class="btn-secondary" href="index.php">Retour à l'accueil</a>
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
