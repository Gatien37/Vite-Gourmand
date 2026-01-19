<?php
/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';

/* ========== Récupération des commandes utilisateur ========== */

$userId     = (int) $_SESSION['user']['id'];
$commandes  = getCommandesByUtilisateur($pdo, $userId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Commandes utilisateur";
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
    <h1>Mes commandes</h1>
    <p>Consultez vos commandes passées et en cours.</p>
</section>

<!-- ===== Messages de retour ===== -->

<?php if (!empty($_SESSION['success'])): ?>
    <p class="alert-success">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </p>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <p class="error-message">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<!-- ===== Liste des commandes ===== -->
<section class="orders-container">
    <div class="table-wrapper">

        <table class="orders-table">

            <!-- En-tête du tableau -->
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <!-- Aucune commande -->
                <?php if (empty($commandes)): ?>
                    <tr>
                        <td colspan="6">Aucune commande enregistrée.</td>
                    </tr>

                <!-- Liste des commandes -->
                <?php else: ?>
                    <?php foreach ($commandes as $commande): ?>
                        <tr>

                            <!-- Menu -->
                            <td><?= htmlspecialchars($commande['menu_nom']) ?></td>

                            <!-- Date -->
                            <td>
                                <?= date('d/m/Y', strtotime($commande['date_prestation'])) ?>
                            </td>

                            <!-- Statut -->
                            <td>
                                <span class="status <?= htmlspecialchars($commande['statut']) ?>">
                                    <?= ucfirst(str_replace('_', ' ', $commande['statut'])) ?>
                                </span>

                                <?php if (!empty($commande['pret_materiel']) && !empty($commande['date_limite_retour'])): ?>
                                    <div class="retour-materiel">
                                        ⚠️ Matériel à restituer avant le
                                        <?= date('d/m/Y', strtotime($commande['date_limite_retour'])) ?>
                                    </div>
                                <?php endif; ?>
                            </td>

                            <!-- Total -->
                            <td>
                                <?= number_format((float) $commande['prix_total'], 2) ?> €
                            </td>

                            <!-- Actions -->
                            <td>
                                <div class="order-actions">

                                    <!-- Détails -->
                                    <a
                                        href="commande-detail.php?id=<?= (int) $commande['id'] ?>"
                                        class="btn-commande"
                                    >
                                        Détails
                                    </a>

                                    <!-- Actions possibles si commande en attente -->
                                    <?php if ($commande['statut'] === 'en_attente'): ?>

                                        <a
                                            href="commande-modifier.php?id=<?= (int) $commande['id'] ?>"
                                            class="btn-secondary"
                                        >
                                            Modifier
                                        </a>

                                        <form
                                            method="POST"
                                            action="commande-annuler.php"
                                            class="js-confirm-annulation"
                                        >
                                            <input
                                                type="hidden"
                                                name="commande_id"
                                                value="<?= (int) $commande['id'] ?>"
                                            >

                                            <button type="submit" class="btn-secondary">
                                                Annuler
                                            </button>
                                        </form>

                                    <?php endif; ?>

                                    <!-- Laisser un avis si commande terminée -->
                                    <?php if ($commande['statut'] === 'terminee'): ?>
                                        <a
                                            href="laisser-un-avis.php?commande_id=<?= (int) $commande['id'] ?>"
                                            class="btn-commande"
                                        >
                                            Laisser un avis
                                        </a>
                                    <?php endif; ?>

                                </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
</section>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
