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
            <a class="btn-commande" href="commande-utilisateur.php">Voir mes commandes</a>
            <a class="btn-secondary" href="index.php">Retour à l'accueil</a>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
