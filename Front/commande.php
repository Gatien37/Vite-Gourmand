<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commander - Vite & Gourmand</title>
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
            <button>Se connecter</button>
            <button>Créer un compte</button>
        </div>
    </div>
</header>

    <section class="commande-hero">
        <h1>Passer commande</h1>
        <p>Complétez les informations ci-dessous pour finaliser votre commande.</p>
    </section>

    <section class="commande-container">

        <!-- RÉCAPITULATIF DU MENU CHOISI -->
        <div class="recap-menu">
            <h2>Votre menu</h2>
            <img src="assets/images/menu-noel.jpg" alt="Image du menu">
            <h3>Menu Festif de Noël</h3>
            <p>Prix : 24,90 € / personne</p>
            <p>Minimum : 6 personnes</p>
        </div>

        <!-- FORMULAIRE DE COMMANDE -->
        <form class="commande-form" action="#" method="POST">
            
            <h2>Informations de commande</h2>
            <label for="quantite">Nombre de personnes</label>
            <input type="number" id="quantite" name="quantite" min="6" placeholder="Ex : 8">
            <label for="date">Date de livraison / retrait</label>
            <input type="date" id="date" name="date">
            <label for="heure">Heure souhaitée</label>
            <input type="time" id="heure" name="heure">

            <h2>Mode de réception</h2>
            <label>
                <input type="radio" name="reception" value="retrait">
                Retrait sur place (gratuit)
            </label>
            <label>
                <input type="radio" name="reception" value="livraison">
                Livraison (5 € + 0,59 €/km)
            </label>
            <div class="livraison-adresse">
                <label for="adresse">Adresse de livraison</label>
                <input type="text" id="adresse" name="adresse" placeholder="Votre adresse">

                <label for="ville">Ville</label>
                <input type="text" id="ville" name="ville" placeholder="Votre ville">

                <label for="code-postal">Code postal</label>
                <input type="text" id="code-postal" name="code_postal" placeholder="Code postal">
            </div>

            <h2>Message au traiteur (optionnel)</h2>
            <textarea id="message" name="message" rows="4" placeholder="Ex : Allergies, instructions spéciales…"></textarea>
            <button type="submit" class="btn-commande">Valider la commande</button>
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
            <p>&copy; 2024 Vite & Gourmand. Tous droits réservés.</p>
        </div>
    </div>
</footer>

</body>
</html>
