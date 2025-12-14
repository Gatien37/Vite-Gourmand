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
        <h1>Traiteur à Bordeaux depuis 25 ans</h1>
        <button>Découvrir les menus</button>
    </section>

    <section class="histoire">
        <img src="assets/images/histoire.jpg" alt="assortiment de fruits frais">
        <div class="histoire-text">
            <h2>Notre Histoire</h2>
            <p>Depuis plus de 25 ans, Julie et José mettent leur passion de la cuisine au service des familles et des entreprises de la région bordelaise.
                D'un petit atelier artisanal à un véritable service traiteur reconnu, leur savoir-faire s'est construit autour d'une idée simple : proposer des plats
                généreux, préparés avec des produits frais et locaux, et livrés avec une
                exigence de qualité qui ne faiblit jamais.</p><br>
            <p>Au fil des années, Vite & Gourmand est devenu un partenaire de confiance pour les grands événements comme pour les moments du quotidien.Derrière chaque menu,
                il y a l'envie de partager, de simplifier l'organisation, et d'apporter une touche de convivialité à chaque table.</p>
        </div>
    </section>

    <section class="experience">
        <h2>25 ans d'expérience</h2>
        <div class="experience-photos">
            <img src="assets/images/experience1.jpg" alt="José et Julie en cuisine">
            <img src="assets/images/experience2.jpg" alt="plateau de petits fours salés">
            <img src="assets/images/experience3.jpg" alt="seau de bouteilles de champagne">
        </div>
        <div class="experience-icons">
            <div class="icon-item">
                <img src="assets/images/icone_clock.svg" alt="icone horloge">
                <p>Ponctualité</p>
            </div>
            <div class="icon-item">
                <img src="assets/images/icone_check.svg" alt="icone check">
                <p>Frais & local</p>
            </div>
            <div class="icon-item">
                <img src="assets/images/icone_utensils.svg" alt="icone ustensils">
                <p>Savoir-faire artisanal</p>
            </div>
            <div class="icon-item">
                <img src="assets/images/icone_heart.svg" alt="icone coeur">
                <p>Service sur-mesure</p>
            </div>
        </div>
    </section>

    <section class="avis">
        <h2>Avis</h2>
        <div class="avis-container">
            <div class="avis-card">
                <div class="avis-header">
                    <div class="avis-stars">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                    </div>
                    <h3>Claire M.</h3>
                </div>
                <p>“Les plats étaient délicieux et la livraison parfaitement à l'heure.Toute la famille a adoré notre menu de Noël.Un service fiable et chaleureux.”</p>
            </div>
            <div class="avis-card">
                <div class="avis-header">
                    <div class="avis-stars">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                    </div>
                    <h3>Julien R.</h3>
                </div>
                <p>“Nous avons commandé pour un événement d'entreprise : frais, bien présenté, très généreux. Julie et José ont été aux petits soins. Je recommande vivement !”</p>
            </div>
            <div class="avis-card">
                <div class="avis-header">
                    <div class="avis-stars">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                        <img src="assets/images/icone_star.svg" alt="étoile de notation">
                    </div>
                    <h3>Sophie L.</h3>
                </div>
                <p>“Très bon rapport qualité-prix. Le menu était savoureux et bien préparé. Petit bémol sur le dessert un peu sucré, mais globalement excellent.”</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="horaires">
                <h3>Horaires</h3>
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
