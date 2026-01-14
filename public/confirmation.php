<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$commande = getCommandeById($pdo, (int)$_GET['id']);

if (!$commande) {
    header('Location: index.php');
    exit;
}
?>

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
        <h1>🎉 Commande confirmée !</h1>
        <p>Merci pour votre confiance. Votre commande a bien été enregistrée.</p>
    </section>

    <section class="confirmation-container">
        <div class="confirmation-card">
            <h2>Récapitulatif</h2>
            <p><strong>Menu :</strong> <?= htmlspecialchars($commande['menu_nom']) ?></p>
            <p><strong>Nombre de personnes :</strong> <?= (int)$commande['quantite'] ?></p>
            <p><strong>Date :</strong>
                <?= date('d/m/Y', strtotime($commande['date_prestation'])) ?>
            </p>
            <p><strong>Heure :</strong>
                <?= date('H:i', strtotime($commande['date_prestation'])) ?>
            </p>
            <p><strong>Adresse :</strong>
                <?= htmlspecialchars($commande['adresse']) ?>,
                <?= htmlspecialchars($commande['ville']) ?>
            </p>
            <p><strong>Total :</strong>
                <?= number_format($commande['prix_total'], 2, ',', ' ') ?> €
            </p>
            <p><strong>Statut :</strong>
                <?= htmlspecialchars($commande['statut']) ?>
            </p>

            <p class="confirmation-message">
                Un e-mail de confirmation vient de vous être envoyé.<br>
                Vous pourrez suivre l'avancée de votre commande dans votre espace client.
            </p>
            <a class="btn-commande" href="commande-utilisateur.php">Voir mes commandes</a>
            <a class="btn-secondary" href="index.php">Retour à l'accueil</a>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
