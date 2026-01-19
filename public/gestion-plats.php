<?php
/* ========== Sécurité : accès employé ou administrateur ========== */

require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/platModel.php';

/* ========== Récupération des plats ========== */

$plats = getAllPlats($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Gestion des plats";
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
    <h1>Gestion des plats</h1>
    <p>Activez, désactivez ou modifiez les plats proposés.</p>
</section>

<section class="plats-admin-container">

    <!-- ===== Tableau des plats ===== -->
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
                <?php
                /* Menus impactés par le plat */
                $menusImpactes = getMenusImpactesParPlat($pdo, (int) $plat['id']);
                ?>

                <tr>

                    <!-- Nom -->
                    <td><?= htmlspecialchars($plat['nom']) ?></td>

                    <!-- Type -->
                    <td><?= ucfirst($plat['type']) ?></td>

                    <!-- Statut -->
                    <td>
                        <?php if ($plat['actif']): ?>
                            <span class="status actif">Actif</span>
                        <?php else: ?>
                            <span class="status inactif">Inactif</span>
                        <?php endif; ?>
                    </td>

                    <!-- Actions -->
                    <td>

                        <a
                            href="form-plat.php?id=<?= (int) $plat['id'] ?>"
                            class="btn-commande"
                        >
                            Modifier
                        </a>

                        <?php if ($plat['actif']): ?>
                            <a
                                href="toggle-plat.php?id=<?= (int) $plat['id'] ?>&action=desactiver"
                                class="btn-secondary btn-delete"
                            >
                                Désactiver
                            </a>
                        <?php else: ?>
                            <a
                                href="toggle-plat.php?id=<?= (int) $plat['id'] ?>&action=activer"
                                class="btn-commande"
                            >
                                Activer
                            </a>
                        <?php endif; ?>

                        <!-- Menus impactés -->
                        <?php if (!empty($menusImpactes)): ?>
                            <details class="impact-details">
                                <summary>
                                    Menus impactés (<?= count($menusImpactes) ?>)
                                </summary>
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

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
