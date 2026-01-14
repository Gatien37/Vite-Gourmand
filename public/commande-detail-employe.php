<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: gestion-commandes.php');
    exit;
}

$commandeId = (int) $_GET['id'];
$commande = getCommandeById($pdo, $commandeId);

if (!$commande) {
    header('Location: gestion-commandes.php');
    exit;
}

$date = new DateTime($commande['date_prestation']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Détail commande employé";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Commande #CMD-<?= (int)$commande['id'] ?></h1>
    <p>Détail complet de la commande client</p>
</section>

<section class="order-detail-container">

    <div class="order-card">

        <h3>Informations client</h3>
        <p><strong>Nom :</strong> <?= htmlspecialchars($commande['client_nom']) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($commande['client_email']) ?></p>
        <p><strong>GSM :</strong> <?= htmlspecialchars($commande['client_gsm']) ?></p>

        <h3>Commande</h3>
        <p><strong>Menu :</strong> <?= htmlspecialchars($commande['menu_nom']) ?></p>
        <p><strong>Date prestation :</strong> <?= $date->format('d/m/Y') ?></p>
        <p><strong>Heure :</strong> <?= $date->format('H:i') ?></p>
        <p><strong>Nombre de personnes :</strong> <?= (int)$commande['quantite'] ?></p>

        <?php if (!empty($commande['adresse'])): ?>
            <h3>Adresse</h3>
            <p>
                <?= htmlspecialchars($commande['adresse']) ?><br>
                <?= htmlspecialchars($commande['ville']) ?>
            </p>
        <?php endif; ?>

        <h3>Statut</h3>
        <span class="status-en-cours">
            <?= ucfirst(str_replace('_', ' ', htmlspecialchars($commande['statut']))) ?>
        </span>

        <h3>Total</h3>
        <p><strong><?= number_format($commande['prix_total'], 2, ',', ' ') ?> €</strong></p>

        <div class="order-actions">

            <a href="#" class="btn-secondary">
                Modifier la commande
            </a>

            <a href="#" class="btn-secondary btn-delete">
                Annuler la commande
            </a>

            <a href="gestion-commandes.php" class="btn-secondary">
                ← Retour à la gestion des commandes
            </a>

        </div>


    </div>

</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
