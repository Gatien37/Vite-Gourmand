<?php
/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';


/* ========== Sécurisation de la méthode HTTP ========== */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Récupération des données ========== */

$commandeId = (int) ($_POST['commande_id'] ?? 0);
$userId     = (int) $_SESSION['user']['id'];

/* ========== Récupération de la commande ========== */

$commande = getCommandeById($pdo, $commandeId);

/* ========== Sécurité : propriété de la commande ========== */

if (!$commande || (int) $commande['utilisateur_id'] !== $userId) {
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Règle métier : annulation autorisée uniquement si en attente ========== */

if ($commande['statut'] !== 'en_attente') {
    $_SESSION['error'] = "Impossible d'annuler : commande déjà traitée.";
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Traitement de l'annulation ========== */

try {
    $pdo->beginTransaction();

    // Mise à jour du statut de la commande
    $stmtUpdate = $pdo->prepare("
        UPDATE commande
        SET statut = 'annulee'
        WHERE id = :id
    ");
    $stmtUpdate->execute(['id' => $commandeId]);

    // Ajout dans l'historique de suivi
    $stmtSuivi = $pdo->prepare("
        INSERT INTO commande_suivi (commande_id, statut)
        VALUES (:commande_id, 'annulee')
    ");
    $stmtSuivi->execute(['commande_id' => $commandeId]);

    // Restitution du stock du menu
    $stmtStock = $pdo->prepare("
        UPDATE menu
        SET stock = stock + :nb
        WHERE id = :menu_id
    ");
    $stmtStock->execute([
        'nb'      => (int) $commande['nb_personnes'],
        'menu_id'=> (int) $commande['menu_id']
    ]);

    $pdo->commit();

    $_SESSION['success'] = "Commande annulée avec succès.";

} catch (Exception $e) {

    $pdo->rollBack();
    $_SESSION['error'] = "Erreur lors de l'annulation de la commande.";
}

/* ========== Redirection finale ========== */

header('Location: commande-utilisateur.php');
exit;

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
</main>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
