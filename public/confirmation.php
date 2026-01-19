<?php
/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

/* ========== Sécurité : paramètre de commande valide ========== */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

/* ========== Récupération de la commande ========== */

$commandeId = (int) $_GET['id'];
$commande   = getCommandeById($pdo, $commandeId);

/* ========== Sécurité : commande existante ========== */

if (!$commande) {
    header('Location: index.php');
    exit;
}

/* ========== Sécurité : propriété de la commande ========== */

if ((int) $commande['utilisateur_id'] !== (int) $_SESSION['utilisateur']['id']) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Confirmation de commande";
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
    <h1>Commande confirmée</h1>
    <p>Merci pour votre confiance. Votre commande a bien été enregistrée.</p>
</section>

<section class="confirmation-container">
    <div class="confirmation-card">

        <h2>Récapitulatif de votre commande</h2>

        <!-- Menu -->
        <p>
            <strong>Menu :</strong>
            <?= htmlspecialchars($commande['menu_nom']) ?>
        </p>

        <!-- Quantité -->
        <p>
            <strong>Nombre de personnes :</strong>
            <?= (int) $commande['quantite'] ?>
        </p>

        <!-- Date et heure -->
        <p>
            <strong>Date :</strong>
            <?= date('d/m/Y', strtotime($commande['date_prestation'])) ?>
            à <?= date('H:i', strtotime($commande['date_prestation'])) ?>
        </p>

        <!-- Mode de réception -->
        <?php if (!empty($commande['adresse'])): ?>
            <p>
                <strong>Adresse de livraison :</strong>
                <?= htmlspecialchars($commande['adresse']) ?>,
                <?= htmlspecialchars($commande['code_postal']) ?>
                <?= htmlspecialchars($commande['ville']) ?>
            </p>
        <?php else: ?>
            <p>
                <strong>Mode de réception :</strong>
                Retrait sur place
            </p>
        <?php endif; ?>

        <!-- Total -->
        <p>
            <strong>Total :</strong>
            <?= number_format((float) $commande['prix_total'], 2, ',', ' ') ?> €
        </p>

        <!-- Statut -->
        <p>
            <strong>Statut :</strong>
            <?= htmlspecialchars($commande['statut']) ?>
        </p>

        <!-- Message confirmation -->
        <p class="confirmation-message">
            Un e-mail de confirmation vous a été envoyé.<br>
            Vous pouvez suivre l’avancement de votre commande depuis votre espace client.
        </p>

        <!-- Actions -->
        <a class="btn-commande" href="commande-utilisateur.php">
            Voir mes commandes
        </a>

        <a class="btn-secondary" href="index.php">
            Retour à l’accueil
        </a>

        <!-- ===== Rappel légal ===== -->
        <p class="legal-hint">
            Commande effectuée auprès de <strong>Vite & Gourmand SARL</strong> —
            <a href="cgv.php" target="_blank" rel="noopener">CGV</a> |
            <a href="mentions-legales.php" target="_blank" rel="noopener">Mentions légales</a>
        </p>

    </div>
</section>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
