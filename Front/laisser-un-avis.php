<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laisser un avis - Vite & Gourmand</title>
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

    <section class="avis-hero">
        <h1>Laisser un avis</h1>
        <p>Partagez votre expérience avec Vite & Gourmand.</p>
    </section>

    <section class="avis-container">
        <form class="avis-form" action="#" method="POST">
            <h2>Votre commande</h2>
            <!-- Exemple statique, sera dynamique en PHP -->
            <p><strong>Menu :</strong> Menu Festif de Noël</p>
            <p><strong>Commande :</strong> #CMD-1023</p>
            <h2>Votre note</h2>
            <div class="rating">
                <label>
                    <input type="radio" name="note" value="1">
                    ⭐
                </label>
                <label>
                    <input type="radio" name="note" value="2">
                    ⭐⭐
                </label>
                <label>
                    <input type="radio" name="note" value="3">
                    ⭐⭐⭐
                </label>
                <label>
                    <input type="radio" name="note" value="4">
                    ⭐⭐⭐⭐
                </label>
                <label>
                    <input type="radio" name="note" value="5">
                    ⭐⭐⭐⭐⭐
                </label>
            </div>
            <h2>Votre commentaire</h2>
            <textarea name="commentaire" rows="5" placeholder="Donnez votre avis sur le menu, la livraison, la qualité des plats…"></textarea>
            <button type="submit" class="btn-commande">Envoyer mon avis</button>
            <div class="auth-links">
                <a href="commandes-utilisateur.php">← Retour à mes commandes</a>
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
                <p>&copy; 2024 Vite & Gourmand. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

</body>
</html>
