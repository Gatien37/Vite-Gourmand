<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/avisModel.php';

$avisList = getAllAvis($pdo);

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
        <h1>Gestion des avis</h1>
        <p>Validez ou refusez les avis déposés par les clients.</p>
    </section>

    <section class="avis-admin-container">
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
                    <td>#<?= $avis['id'] ?></td>
                    <td><?= htmlspecialchars($avis['prenom'] . ' ' . $avis['nom']) ?></td>
                    <td>Commande #<?= $avis['commande_id'] ?></td>
                    <td><?= str_repeat('⭐', (int)$avis['note']) ?></td>
                    <td><?= htmlspecialchars($avis['commentaire']) ?></td>
                    <td>
                        <?php if ($avis['valide']): ?>
                            <span class="status valide">Validé</span>
                        <?php else: ?>
                            <span class="status attente">En attente</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!$avis['valide']): ?>
                            <a href="toggle-avis.php?id=<?= $avis['id'] ?>&action=valider"
                            class="btn-commande">Valider</a>
                        <?php endif; ?>

                        <?php if ($avis['valide']): ?>
                            <a href="toggle-avis.php?id=<?= $avis['id'] ?>&action=refuser"
                            class="btn-secondary btn-delete">Refuser</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
