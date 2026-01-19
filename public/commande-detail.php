<?php
/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

/* ========== Récupération et validation des données ========== */
$commandeId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$userId     = (int) $_SESSION['user']['id'];

$commande = getCommandeById($pdo, $commandeId);

/* ========== Sécurité : propriété de la commande ========== */
if (!$commande || (int) $commande['utilisateur_id'] !== $userId) {
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Suivi et données dérivées ========== */
$suivi = getCommandeSuivi($pdo, $commandeId);
$date  = new DateTime($commande['date_prestation']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Détail commande";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <section class="hero-section commandes-hero">
        <h1>Détail de la commande</h1>
        <p>Retrouvez toutes les informations concernant votre commande.</p>
    </section>

    <section class="order-detail-container">
        <div class="order-card">

            <h2>Commande #CMD-<?= (int) $commande['id'] ?></h2>

            <p class="status <?= htmlspecialchars($commande['statut']) ?>">
                Statut :
                <?= ucfirst(str_replace('_', ' ', htmlspecialchars($commande['statut']))) ?>
            </p>

            <h3>Informations du menu</h3>
            <p><strong>Menu :</strong> <?= htmlspecialchars($commande['menu_nom']) ?></p>
            <p><strong>Quantité :</strong> <?= (int) $commande['quantite'] ?> personnes</p>
            <p>
                <strong>Total :</strong>
                <?= number_format((float) $commande['prix_total'], 2, ',', ' ') ?> €
            </p>

            <h3>Date &amp; heure</h3>
            <p><strong>Date :</strong> <?= $date->format('d/m/Y') ?></p>
            <p><strong>Heure :</strong> <?= $date->format('H:i') ?></p>

            <h3>Mode de réception</h3>

            <?php if ($commande['adresse'] === 'Retrait sur place'): ?>
                <p><strong>Type :</strong> Retrait sur place</p>
            <?php else: ?>
                <p><strong>Type :</strong> Livraison</p>
                <p>
                    <?= htmlspecialchars($commande['adresse']) ?><br>
                    <?= htmlspecialchars($commande['ville']) ?>
                </p>
            <?php endif; ?>

            <h3>Suivi de la commande</h3>
            <ul class="commande-suivi">
                <?php foreach ($suivi as $etat): ?>
                    <li>
                        <strong>
                            <?= ucfirst(str_replace('_', ' ', htmlspecialchars($etat['statut']))) ?>
                        </strong>
                        —
                        <?= date('d/m/Y H:i', strtotime($etat['date_statut'])) ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="order-actions">
                <a href="commande-utilisateur.php" class="btn-secondary">
                    ← Retour aux commandes
                </a>
            </div>

        </div>
    </section>

</main>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
