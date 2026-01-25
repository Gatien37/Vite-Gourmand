<?php

/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

/* ========== Génération du token CSRF ========== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ========== Récupération des commandes utilisateur ========== */
$userId    = (int) $_SESSION['user']['id'];
$commandes = getCommandesByUtilisateur($pdo, $userId);
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

<main id="main-content">

    <section class="hero-section commandes-hero">
        <h1>Mes commandes</h1>
        <p>Consultez vos commandes passées et en cours.</p>
    </section>

    <!-- Messages de retour -->
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

    <!-- Liste des commandes -->
    <section class="orders-container">
        <div class="table-wrapper">

            <table class="orders-table">
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

                <?php if (empty($commandes)): ?>
                    <tr>
                        <td colspan="6">Aucune commande enregistrée.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($commandes as $commande): ?>
                        <tr>

                            <td><?= htmlspecialchars($commande['menu_nom']) ?></td>

                            <td><?= date('d/m/Y', strtotime($commande['date_prestation'])) ?></td>

                            <td>
                                <span class="status <?= htmlspecialchars($commande['statut']) ?>">
                                    <?= ucfirst(str_replace('_', ' ', $commande['statut'])) ?>
                                </span>
                            </td>

                            <td><?= number_format((float) $commande['prix_total'], 2) ?> €</td>

                            <td>
                                <div class="order-actions">

                                    <a
                                        href="commande-detail.php?id=<?= (int) $commande['id'] ?>"
                                        class="btn-commande"
                                    >
                                        Détails
                                    </a>

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

                                            <input
                                                type="hidden"
                                                name="csrf_token"
                                                value="<?= $_SESSION['csrf_token'] ?>"
                                            >

                                            <button type="submit" class="btn-secondary">
                                                Annuler
                                            </button>
                                        </form>

                                    <?php endif; ?>

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
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
