<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de la commande - Vite & Gourmand</title>
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

    <section class="order-detail-hero">
        <h1>Détail de la commande</h1>
        <p>Retrouvez toutes les informations concernant votre commande.</p>
    </section>

    <section class="order-detail-container">
        <div class="order-card">
            <h2>Commande #CMD-1023</h2>
            <p class="status en-cours">Statut : En cours de préparation</p>
            <h3>Informations du menu</h3>
            <p><strong>Menu :</strong> Menu Festif de Noël</p>
            <p><strong>Prix unitaire :</strong> 24,90 €</p>
            <p><strong>Quantité :</strong> 8 personnes</p>
            <p><strong>Total :</strong> 199,20 €</p>
            <h3>Date & Heure</h3>
            <p><strong>Date :</strong> 24 décembre 2024</p>
            <p><strong>Heure :</strong> 19h30</p>
            <h3>Mode de réception</h3>
            <p><strong>Type :</strong> Livraison</p>
            <h3>Adresse de livraison</h3>
            <p>25 Rue des Lilas<br>33000 Bordeaux</p>
            <h3>Message au traiteur</h3>
            <p>Aucun message.</p>
            <div class="order-actions">
                <a href="commandes-utilisateur.php" class="btn-secondary">← Retour aux commandes</a>
                <!-- Bouton d'avis visible uniquement après livraison -->
                <a href="laisser-avis.php" class="btn-commande">Laisser un avis</a>
            </div>
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
