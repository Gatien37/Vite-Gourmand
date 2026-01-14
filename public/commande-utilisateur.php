<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

$userId = $_SESSION['user']['id'];
$commandes = getCommandesByUtilisateur($pdo, $userId);
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
        <h1>Mes commandes</h1>
        <p>Consultez vos commandes passées et en cours.</p>
    </section>

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

                                    <?php if (!empty($commande['pret_materiel']) && !empty($commande['date_limite_retour'])): ?>
                                        <div class="retour-materiel">
                                            ⚠️ Matériel à restituer avant le
                                            <?= date('d/m/Y', strtotime($commande['date_limite_retour'])) ?>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <td><?= number_format((float)$commande['prix_total'], 2) ?> €</td>
                                <td>
                                    <div class="order-actions">
                                        <a href="commande-detail.php?id=<?= (int)$commande['id'] ?>" class="btn-commande">
                                            Détails
                                        </a>

                                        <?php if ($commande['statut'] === 'en_attente'): ?>

                                            <a href="commande-modifier.php?id=<?= (int)$commande['id'] ?>"
                                            class="btn-secondary">
                                                Modifier
                                            </a>

                                            <form method="POST"
                                                action="commande-annuler.php"
                                                onsubmit="return confirm('Voulez-vous vraiment annuler cette commande ?');">

                                                <input type="hidden" name="commande_id" value="<?= (int)$commande['id'] ?>">

                                                <button type="submit" class="btn-secondary">
                                                    Annuler
                                                </button>

                                            </form>

                                        <?php endif; ?>

                                        <?php if ($commande['statut'] === 'terminee'): ?>
                                            <a href="laisser-un-avis.php?commande_id=<?= (int)$commande['id'] ?>"
                                            class="btn-commande">
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

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
