<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';

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

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <main id="main-content">

        <section class="hero-section commandes-hero">
            <h1>Gestion des menus</h1>
            <p>Ajoutez, modifiez ou supprimez les menus disponibles.</p>
        </section>

            <!-- Bouton ajouter -->
            <div class="add-menu-container">
                <a href="form-menu.php" class="btn-commande"> Ajouter un menu</a>
            </div>
        <section class="menus-admin-container">
            <!-- Tableau des menus -->
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
                            <a href="form-menu.php?id=<?= $menu['id'] ?>" class="btn-commande">
                                Modifier
                            </a>
                            <a href="delete-menu.php?id=<?= $menu['id'] ?>"
                            class="btn-secondary btn-delete js-confirm-delete">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </section>
    </main>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
