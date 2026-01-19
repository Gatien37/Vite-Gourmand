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

if ($commande['statut'] === 'annulee') {
    header('Location: commande-detail-employe.php?id=' . $commandeId);
    exit;
}

$date = new DateTime($commande['date_prestation']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Modifier commande - employé";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Modifier la commande #CMD-<?= (int)$commande['id'] ?></h1>
    <p>Modification suite à contact client</p>
</section>

<section class="order-detail-container">
    <div class="order-card">

        <form method="POST" action="traiter-modification-commande.php" class="form-card">

            <input type="hidden" name="commande_id" value="<?= (int)$commande['id'] ?>">

            <p class="menu-readonly">
                <?= htmlspecialchars($commande['menu_nom']) ?>
            </p>


            <label for="date">Date *</label>
            <input
                type="date"
                name="date"
                id="date"
                value="<?= $date->format('Y-m-d') ?>"
                required
            >

            <label for="heure">Heure *</label>
            <input
                type="time"
                name="heure"
                id="heure"
                value="<?= $date->format('H:i') ?>"
                required
            >

            <label for="quantite">Nombre de personnes *</label>
            <input
                type="number"
                name="quantite"
                id="quantite"
                min="1"
                value="<?= (int)$commande['quantite'] ?>"
                required
            >

            <label for="adresse">Adresse *</label>
            <input
                type="text"
                name="adresse"
                id="adresse"
                value="<?= htmlspecialchars($commande['adresse'] ?? '') ?>"
                required
            >

            <label for="ville">Ville *</label>
            <input
                type="text"
                name="ville"
                id="ville"
                value="<?= htmlspecialchars($commande['ville'] ?? '') ?>"
                required
            >

            <button type="submit" class="btn-commande">
                Enregistrer les modifications
            </button>
        </form>

        <a href="commande-detail-employe.php?id=<?= $commandeId ?>" class="btn-secondary">
            ← Retour au détail
        </a>

    </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
