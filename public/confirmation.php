<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

/* ================== SÉCURITÉ ================== */

// Utilisateur obligatoirement connecté
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

// Vérification ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$commandeId = (int) $_GET['id'];
$commande = getCommandeById($pdo, $commandeId);

// Commande inexistante
if (!$commande) {
    header('Location: index.php');
    exit;
}

// Vérification que la commande appartient à l'utilisateur connecté
if ((int)$commande['user_id'] !== (int)$_SESSION['user']['id']) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Confirmation de commande";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Commande confirmée</h1>
    <p>Merci pour votre confiance. Votre commande a bien été enregistrée.</p>
</section>

<section class="confirmation-container">
    <div class="confirmation-card">

        <h2>Récapitulatif de votre commande</h2>

        <p><strong>Menu :</strong> <?= htmlspecialchars($commande['menu_nom']) ?></p>

        <p><strong>Nombre de personnes :</strong> <?= (int)$commande['quantite'] ?></p>

        <p>
            <strong>Date :</strong>
            <?= date('d/m/Y', strtotime($commande['date_prestation'])) ?>
            à <?= date('H:i', strtotime($commande['date_prestation'])) ?>
        </p>

        <?php if (!empty($commande['adresse'])): ?>
            <p>
                <strong>Adresse de livraison :</strong>
                <?= htmlspecialchars($commande['adresse']) ?>,
                <?= htmlspecialchars($commande['code_postal']) ?>
                <?= htmlspecialchars($commande['ville']) ?>
            </p>
        <?php else: ?>
            <p><strong>Mode de réception :</strong> Retrait sur place</p>
        <?php endif; ?>

        <p>
            <strong>Total :</strong>
            <?= number_format($commande['prix_total'], 2, ',', ' ') ?> €
        </p>

        <p>
            <strong>Statut :</strong>
            <?= htmlspecialchars($commande['statut']) ?>
        </p>

        <p class="confirmation-message">
            Un e-mail de confirmation vous a été envoyé.<br>
            Vous pouvez suivre l’avancement de votre commande depuis votre espace client.
        </p>

        <a class="btn-commande" href="commande-utilisateur.php">
            Voir mes commandes
        </a>

        <a class="btn-secondary" href="index.php">
            Retour à l’accueil
        </a>

        <!-- ===== RAPPEL LÉGAL ===== -->
        <p class="legal-hint">
            Commande effectuée auprès de <strong>Vite & Gourmand SARL</strong> —
            <a href="cgv.php" target="_blank" rel="noopener">CGV</a> |
            <a href="mentions-legales.php" target="_blank" rel="noopener">Mentions légales</a>
        </p>

    </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
