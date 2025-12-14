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
        <h1>Créer / Modifier un employé</h1>
        <p>Complétez les informations ci-dessous pour enregistrer un employé.</p>
    </section>

    <section class="employe-form-container">
        <form class="employe-form form-card" action="#" method="POST">
            <!-- INFOS PERSONNELLES -->
            <h2>Informations personnelles</h2>
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Ex : Julie">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Ex : Martin">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="email@exemple.com">

            <!-- MOT DE PASSE -->
            <h2>Mot de passe</h2>
            <p class="info">
                (Laissez vide pour conserver l'ancien mot de passe lors d'une modification)
            </p>
            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Laisser vide si inchangé">

            <!-- RÔLE -->
            <h2>Rôle</h2>
            <label for="role">Sélectionnez le rôle</label>
            <select id="role" name="role">
                <option value="employe">Employé</option>
                <option value="admin">Administrateur</option>
            </select>

            <!-- STATUT -->
            <h2>Statut du compte</h2>
            <label for="statut">Statut</label>
            <select id="statut" name="statut">
                <option value="actif">Actif</option>
                <option value="inactif">Inactif</option>
            </select>

            <!-- BOUTONS -->
            <button type="submit" class="btn-commande">Enregistrer l'employé</button>

            <div class="auth-links">
                <a href="gestion-employes.php">← Retour à la liste des employés</a>
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
