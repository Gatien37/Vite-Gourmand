<?php
/* ========== Sécurité : accès employé ou administrateur ========== */

require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/avisModel.php';

/* ========== Récupération des avis clients ========== */

$avisList = getAllAvis($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Gestion des avis";
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
    <h1>Gestion des avis</h1>
    <p>Validez ou refusez les avis déposés par les clients.</p>
</section>

<section class="avis-admin-container">

    <!-- ===== Tableau des avis ===== -->
    <table class="avis-admin-table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Menu</th>
                <th>Note</th>
                <th>Commentaire</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($avisList as $avis): ?>
                <tr>

                    <!-- Identifiant -->
                    <td>#<?= (int) $avis['id'] ?></td>

                    <!-- Client -->
                    <td>
                        <?= htmlspecialchars($avis['prenom'] . ' ' . $avis['nom']) ?>
                    </td>

                    <!-- Commande -->
                    <td>
                        Commande #<?= (int) $avis['commande_id'] ?>
                    </td>

                    <!-- Note -->
                    <td>
                        <?= str_repeat('⭐', (int) $avis['note']) ?>
                    </td>

                    <!-- Commentaire -->
                    <td>
                        <?= htmlspecialchars($avis['commentaire']) ?>
                    </td>

                    <!-- Statut -->
                    <td>
                        <?php if ($avis['valide']): ?>
                            <span class="status valide">Validé</span>
                        <?php else: ?>
                            <span class="status attente">En attente</span>
                        <?php endif; ?>
                    </td>

                    <!-- Actions -->
                    <td>

                        <?php if (!$avis['valide']): ?>
                            <a
                                href="toggle-avis.php?id=<?= (int) $avis['id'] ?>&action=valider"
                                class="btn-commande"
                            >
                                Valider
                            </a>
                        <?php endif; ?>

                        <?php if ($avis['valide']): ?>
                            <a
                                href="toggle-avis.php?id=<?= (int) $avis['id'] ?>&action=refuser"
                                class="btn-secondary btn-delete"
                            >
                                Refuser
                            </a>
                        <?php endif; ?>

                    </td>

                </tr>
            <?php endforeach; ?>

        </tbody>

    </table>
</section>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
