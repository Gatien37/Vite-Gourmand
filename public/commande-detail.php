<?php
/* ========== Initialisation de la session ========== */

session_start();

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

/* ========== Sécurité : utilisateur connecté ========== */

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

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

<!-- ===== Titre ===== -->
<section class="hero-section commandes-hero">
    <h1>Détail de la commande</h1>
    <p>Retrouvez toutes les informations concernant votre commande.</p>
</section>

<section class="order-detail-container">
    <div class="order-card">

        <h2>Commande #CMD-<?= (int) $commande['id'] ?></h2>

        <!-- Statut de la commande -->
        <p class="status <?= htmlspecialchars($commande['statut']) ?>">
            Statut :
            <?= ucfirst(str_replace('_', ' ', htmlspecialchars($commande['statut']))) ?>
        </p>

        <!-- Informations menu -->
        <h3>Informations du menu</h3>
        <p><strong>Menu :</strong> <?= htmlspecialchars($commande['menu_nom']) ?></p>
        <p><strong>Quantité :</strong> <?= (int) $commande['quantite'] ?> personnes</p>
        <p>
            <strong>Total :</strong>
            <?= number_format((float) $commande['prix_total'], 2, ',', ' ') ?> €
        </p>

        <!-- Date et heure -->
        <h3>Date &amp; heure</h3>
        <p><strong>Date :</strong> <?= $date->format('d/m/Y') ?></p>
        <p><strong>Heure :</strong> <?= $date->format('H:i') ?></p>

        <!-- Mode de réception -->
        <h3>Mode de réception</h3>

        <?php if ($commande['adresse'] === 'Retrait sur place'): ?>
            <p><strong>Type :</strong> Retrait sur place</p>
        <?php else: ?>
            <p><strong>Type :</strong> Livraison</p>

            <h3>Adresse de livraison</h3>
            <p>
                <?= htmlspecialchars($commande['adresse']) ?><br>
                <?= htmlspecialchars($commande['ville']) ?>
            </p>
        <?php endif; ?>

        <!-- Suivi de la commande -->
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

        <!-- Actions utilisateur -->
        <div class="order-actions">

            <?php if ($commande['statut'] === 'terminee'): ?>
                <a
                    href="laisser-un-avis.php?id=<?= (int) $commande['id'] ?>"
                    class="btn-avis"
                >
                    Laisser un avis
                </a>
            <?php endif; ?>

            <a href="commande-utilisateur.php" class="btn-secondary">
                ← Retour aux commandes
            </a>

        </div>
    </div>
</section>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
