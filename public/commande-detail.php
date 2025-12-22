<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Accueil";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1>Détail de la commande</h1>
        <p>Retrouvez toutes les informations concernant votre commande.</p>
    </section>

    <section class="order-detail-container">
        <div class="order-card">
            <h2>Commande #CMD-1023</h2>
            <p class="status-en-cours">Statut : En cours de préparation</p>
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
                <a href="laisser-un-avis.php" class="btn-avis">Laisser un avis</a>
                <a href="commande-utilisateur.php" class="btn-secondary">← Retour aux commandes</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
