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

    <section class="menu-form-hero">
        <h1>Créer / Modifier un menu</h1>
        <p>Complétez les champs ci-dessous pour ajouter ou modifier un menu.</p>
    </section>

    <section class="menu-form-container">
        <form class="menu-form" action="#" method="POST" enctype="multipart/form-data">
            <!-- TITRE -->
            <h2>Informations générales</h2>
            <label for="titre">Titre du menu</label>
            <input type="text" id="titre" name="titre" placeholder="Ex : Menu Festif de Noël">
            <label for="prix">Prix par personne (€)</label>
            <input type="number" step="0.01" id="prix" name="prix" placeholder="24.90">
            <label for="theme">Thème</label>
            <input type="text" id="theme" name="theme" placeholder="Ex : Noël, Vegan, Cocktail…">
            <label for="regime">Régime</label>
            <select id="regime" name="regime">
                <option value="classique">Classique</option>
                <option value="vegetarien">Végétarien</option>
                <option value="vegan">Vegan</option>
                <option value="sans-gluten">Sans gluten</option>
            </select>
            <label for="minimum">Nombre minimum de personnes</label>
            <input type="number" id="minimum" name="minimum" placeholder="Ex : 6">
            <label for="stock">Stock disponible</label>
            <input type="number" id="stock" name="stock" placeholder="Ex : 20">

            <!-- DESCRIPTION -->
            <h2>Description</h2>
            <label for="description">Description courte</label>
            <textarea id="description" name="description" rows="4" placeholder="Courte description du menu"></textarea>
            <label for="description-complete">Description complète</label>
            <textarea id="description-complete" name="description_complete" rows="6" placeholder="Description détaillée du menu"></textarea>

            <!-- IMAGES -->
            <h2>Images du menu</h2>
            <label for="image-principale">Image principale</label>
            <input type="file" id="image-principale" name="image_principale">
            <label for="images-galerie">Galerie d'images (optionnel)</label>
            <input type="file" id="images-galerie" name="images_galerie[]" multiple>

            <!-- PLATS -->
            <h2>Plats du menu</h2>
            <label for="entree">Entrée</label>
            <input type="text" id="entree" name="entree" placeholder="Ex : Velouté de potimarron">
            <label for="plat">Plat</label>
            <input type="text" id="plat" name="plat" placeholder="Ex : Dinde farcie aux marrons">
            <label for="dessert">Dessert</label>
            <input type="text" id="dessert" name="dessert" placeholder="Ex : Bûche chocolat-orange">

            <!-- ALLERGENES -->
            <h2>Allergènes</h2>
            <textarea id="allergenes" name="allergenes" rows="4" placeholder="Liste des allergènes potentiels"></textarea>

            <!-- CONDITIONS -->
            <h2>Conditions du menu</h2>
            <textarea id="conditions" name="conditions" rows="5" placeholder="Ex : Commande 48h à l'avance, livraison froide…"></textarea>

            <!-- BOUTON VALIDATION -->
            <button type="submit" class="btn-commande">Enregistrer le menu</button>
            <div class="auth-links">
                <a href="gestion-menus.php">← Retour à la liste des menus</a>
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
