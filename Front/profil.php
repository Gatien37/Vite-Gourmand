<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil - Vite & Gourmand</title>
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

    <section class="profil-hero">
        <h1>Mon profil</h1>
        <p>Modifiez vos informations personnelles.</p>
    </section>

    <section class="profil-container">
        <form class="profil-form" action="#" method="POST">
            <!-- Informations personnelles -->
            <h2>Informations personnelles</h2>
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Votre prénom">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.com">
            <label for="telephone">Téléphone</label>
            <input type="text" id="telephone" name="telephone" placeholder="Votre numéro">

            <!-- Adresse -->
            <h2>Adresse</h2>
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" placeholder="Votre adresse">
            <label for="ville">Ville</label>
            <input type="text" id="ville" name="ville" placeholder="Votre ville">
            <label for="code-postal">Code postal</label>
            <input type="text" id="code-postal" name="code_postal" placeholder="Code postal">

            <!-- Mot de passe -->
            <h2>Modifier mon mot de passe</h2>
            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Nouveau mot de passe">
            <label for="confirm-password">Confirmer le mot de passe</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirmez le mot de passe">
            <button type="submit" class="btn-commande">Enregistrer les modifications</button>
            <div class="auth-links">
                <a href="espace-utilisateur.php">Retour à mon tableau de bord</a>
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
