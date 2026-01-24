<?php
/* ========== Sécurité : accès employé ou administrateur ========== */
require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/platModel.php';

/* ========== Génération du token CSRF ========== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ========== Récupération des plats ========== */
$plats = getAllPlats($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Gestion des plats";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main id="main-content">

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
                    <?php
                    $menusImpactes = getMenusImpactesParPlat($pdo, (int) $plat['id']);
                    ?>

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

                            <a
                                href="form-plat.php?id=<?= (int) $plat['id'] ?>"
                                class="btn-commande"
                            >
                                Modifier
                            </a>

                            <?php if ($plat['actif']): ?>
                                <form method="POST" action="toggle-plat.php">
                                    <input type="hidden" name="id" value="<?= (int) $plat['id'] ?>">
                                    <input type="hidden" name="action" value="desactiver">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                                    <button type="submit" class="btn-secondary btn-delete">
                                        Désactiver
                                    </button>
                                </form>
                            <?php else: ?>
                                <form method="POST" action="toggle-plat.php">
                                    <input type="hidden" name="id" value="<?= (int) $plat['id'] ?>">
                                    <input type="hidden" name="action" value="activer">
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                                    <button type="submit" class="btn-commande">
                                        Activer
                                    </button>
                                </form>
                            <?php endif; ?>

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
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
