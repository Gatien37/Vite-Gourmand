<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
    <header>
        <div class="header-container">
            <img src="assets/images/logo.png" alt="logo Vite & Gourmand">
            <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="menus.php">Menu</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            </nav>
            <div class="buttons">
                <button>Se connecter</button>
                <button>Créer un compte</button>
            </div>
        </div>
    </header>
    
    <section class="contact-hero">
        <h1>Contactez-nous</h1>
        <p>Une question ? Un événement à organiser ? Nous sommes là pour vous aider.</p>
    </section>

    <section class="contact-container">
        <div class="contact-form">
            <h2>Envoyer un message</h2>
            <form action="#" method="POST">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom">

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Votre adresse e-mail">

                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" placeholder="Votre numéro">

                <label for="sujet">Sujet</label>
                <input type="text" id="sujet" name="sujet" placeholder="Sujet de votre message">

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="6" placeholder="Votre message"></textarea>

                <button class="btn-commande" type="submit">Envoyer</button>
            </form>
        </div>
        <div class="contact-infos">
            <h2>Nos coordonnées</h2>
            <p><strong>Adresse :</strong><br>12 Rue des Gourmets, 33000 Bordeaux</p>

            <p><strong>Téléphone :</strong><br>05 56 48 32 10</p>

            <p><strong>Email :</strong><br>contact@viteetgourmand.fr</p>

            <p><strong>Horaires :</strong><br>
                Lundi - Vendredi : 9h-18h<br>
                Samedi : 10h-14h<br>
                Dimanche : Fermé
            </p>
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
                <p>Email : contact@viteetgourmand.fr </p>
            </div>
            <div class="legal">
                <a href="#">Mentions légales</a>
                <a href="#">Conditions Générales de Vente</a>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Vite & Gourmand. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>