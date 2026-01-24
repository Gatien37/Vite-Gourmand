<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';

/* ===== CSRF ===== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$menus = getAllMenus($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Gestion des menus";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main id="main-content">

    <section class="hero-section commandes-hero">
        <h1>Gestion des menus</h1>
        <p>Ajoutez, modifiez ou supprimez les menus disponibles.</p>
    </section>

    <div class="add-menu-container">
        <a href="form-menu.php" class="btn-commande">Ajouter un menu</a>
    </div>

    <section class="menus-admin-container">
        <table class="menus-admin-table">
            <thead>
                <tr>
                    <th>Nom du menu</th>
                    <th>Prix / pers.</th>
                    <th>Thème</th>
                    <th>Régime</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($menus as $menu): ?>
                <tr>
                    <td><?= htmlspecialchars($menu['nom']) ?></td>
                    <td><?= number_format($menu['prix_base'], 2, ',', ' ') ?> €</td>
                    <td><?= htmlspecialchars($menu['theme']) ?></td>
                    <td><?= htmlspecialchars($menu['regime']) ?></td>
                    <td>

                        <!-- Modifier -->
                        <a href="form-menu.php?id=<?= (int) $menu['id'] ?>" class="btn-commande">
                            Modifier
                        </a>

                        <!-- Supprimer -->
                        <form
                            method="POST"
                            action="delete-menu.php"
                        >
                            <input type="hidden" name="menu_id" value="<?= (int) $menu['id'] ?>">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                            <button type="submit" class="btn-secondary btn-delete">
                                Supprimer
                            </button>
                        </form>

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
