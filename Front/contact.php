<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Accueil";
    require_once __DIR__ . '/partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/partials/header.php'; ?>
    
    <section class="hero-section commandes-hero">
        <h1>Contactez-nous</h1>
        <p>Une question ? Un événement à organiser ? Nous sommes là pour vous aider.</p>
    </section>

    <section class="contact-container">
        <div class="contact-form form-card">
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

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>