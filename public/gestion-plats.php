<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/platModel.php';

$plats = getAllPlats($pdo);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php require_once __DIR__ . '/../partials/head.php'; ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Gestion des plats</h1>
    <p>Activez, désactivez ou modifiez les plats proposés.</p>
</section>

<section class="plats-admin-container">

    <table class="plats-admin-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($plats as $plat): ?>
            <?php $menusImpactes = getMenusImpactesParPlat($pdo, (int)$plat['id']); ?>

            <tr>
                <td><?= htmlspecialchars($plat['nom']) ?></td>
                <td><?= ucfirst($plat['type']) ?></td>
                <td>
                    <?php if ($plat['actif']): ?>
                        <span class="status actif">Actif</span>
                    <?php else: ?>
                        <span class="status inactif">Inactif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="form-plat.php?id=<?= $plat['id'] ?>" class="btn-commande">Modifier</a>

                    <?php if ($plat['actif']): ?>
                        <a href="toggle-plat.php?id=<?= $plat['id'] ?>&action=desactiver"
                        class="btn-secondary btn-delete">Désactiver</a>
                    <?php else: ?>
                        <a href="toggle-plat.php?id=<?= $plat['id'] ?>&action=activer"
                        class="btn-commande">Activer</a>
                    <?php endif; ?>

                    <?php if (!empty($menusImpactes)): ?>
                        <details class="impact-details">
                            <summary>Menus impactés (<?= count($menusImpactes) ?>)</summary>
                            <ul>
                                <?php foreach ($menusImpactes as $menu): ?>
                                    <li><?= htmlspecialchars($menu['nom']) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </details>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
