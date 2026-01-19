<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';
require_once __DIR__ . '/../models/platModel.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$menu = null;
$error = null;
$plats = getAllPlats($pdo);

$platsParType = [
    'entree' => [],
    'plat' => [],
    'dessert' => []
];

foreach ($plats as $p) {
    if ($p['actif']) {
        $platsParType[$p['type']][] = $p;
    }
}


if ($id) {
    $menu = getMenuById($pdo, $id);
    if (!$menu) {
        header('Location: gestion-menus.php');
        exit;
    }
}

$platsSelectionnes = [];

if ($id) {
    $stmt = $pdo->prepare("
        SELECT plat_id
        FROM menu_plat
        WHERE menu_id = ?
    ");
    $stmt->execute([$id]);
    $platsSelectionnes = $stmt->fetchAll(PDO::FETCH_COLUMN);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'nom' => trim($_POST['titre'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'description_longue' => trim($_POST['description_complete'] ?? ''),
        'theme' => trim($_POST['theme'] ?? ''),
        'regime' => $_POST['regime'] ?? '',
        'nb_personnes_min' => (int) ($_POST['minimum'] ?? 0),
        'prix_base' => (float) ($_POST['prix'] ?? 0),
        'stock' => (int) ($_POST['stock'] ?? 0),
    ];

    if (
        !$data['nom'] ||
        !$data['prix_base'] ||
        !$data['nb_personnes_min']
    ) {
        $error = "Les champs obligatoires ne sont pas remplis.";
    } else {

        saveMenu($pdo, $data, $id);

        $menuId = $id ? $id : $pdo->lastInsertId();

        $platsIds = $_POST['plats'] ?? [];
        $platsIds = array_map('intval', $platsIds);

        $stmt = $pdo->prepare("DELETE FROM menu_plat WHERE menu_id = ?");
        $stmt->execute([$menuId]);

        if (!empty($platsIds)) {
            $stmt = $pdo->prepare("
                INSERT INTO menu_plat (menu_id, plat_id)
                VALUES (?, ?)
            ");

            foreach ($platsIds as $platId) {
                $stmt->execute([$menuId, $platId]);
            }
        }

        $stmt = $pdo->prepare("
            SELECT image
            FROM plat
            WHERE id IN (
                SELECT plat_id FROM menu_plat WHERE menu_id = ?
            )
            AND image IS NOT NULL
            LIMIT 1
        ");
        $stmt->execute([$menuId]);
        $image = $stmt->fetchColumn();

        if ($image) {
            $stmt = $pdo->prepare("UPDATE menu SET image = ? WHERE id = ?");
            $stmt->execute([$image, $menuId]);
        }

        header('Location: gestion-menus.php');
        exit;
    }
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Modifier un menu";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1><?= $menu ? 'Modifier un menu' : 'Créer un menu' ?></h1>
        <p>Complétez les champs ci-dessous pour <?= $menu ? 'modifier' : 'ajouter' ?> un menu.</p>
    </section>

    <section class="menu-form-container">
        <form class="menu-form form-card" action="#" method="POST" enctype="multipart/form-data">
            <!-- TITRE -->
            <h2>Informations générales</h2>
            <label for="titre">Titre du menu</label>
            <input type="text" id="titre" name="titre"
                value="<?= htmlspecialchars($menu['nom'] ?? '') ?>">

            <label for="prix">Prix par personne (€)</label>
            <input type="number" step="0.01" id="prix" name="prix"
                value="<?= htmlspecialchars($menu['prix_base'] ?? '') ?>">

            <label for="theme">Thème</label>
            <select id="theme" name="theme">
                <option value="noel" <?= ($menu['theme'] ?? '') === 'noel' ? 'selected' : '' ?>>Noël</option>
                <option value="paques" <?= ($menu['theme'] ?? '') === 'paques' ? 'selected' : '' ?>>Pâques</option>
                <option value="evenement" <?= ($menu['theme'] ?? '') === 'evenement' ? 'selected' : '' ?>>Événement</option>
                <option value="classique" <?= ($menu['theme'] ?? '') === 'classique' ? 'selected' : '' ?>>Classique</option>
            </select>

            <label for="regime">Régime</label>
            <select id="regime" name="regime">
                <option value="classique" <?= ($menu['regime'] ?? '') === 'classique' ? 'selected' : '' ?>>Classique</option>
                <option value="vegetarien" <?= ($menu['regime'] ?? '') === 'vegetarien' ? 'selected' : '' ?>>Végétarien</option>
                <option value="vegan" <?= ($menu['regime'] ?? '') === 'vegan' ? 'selected' : '' ?>>Vegan</option>
            </select>

            <label for="minimum">Nombre minimum de personnes</label>
            <input type="number" id="minimum" name="minimum"
                value="<?= htmlspecialchars($menu['nb_personnes_min'] ?? '') ?>">

            <label for="stock">Stock disponible</label>
            <input type="number" id="stock" name="stock"
                value="<?= htmlspecialchars($menu['stock'] ?? '') ?>">

            <!-- DESCRIPTION -->
            <h2>Description</h2>
            <label for="description">Description courte</label>
            <textarea id="description" name="description" rows="4"><?= htmlspecialchars($menu['description'] ?? '') ?></textarea>

            <label for="description-complete">Description complète</label>
            <textarea id="description-complete" name="description_complete" rows="6"><?= htmlspecialchars($menu['description_longue'] ?? '') ?></textarea>

            <!-- PLATS -->
            <h2>Plats du menu</h2>
            <?php foreach ($platsParType as $type => $liste): ?>
                <fieldset class="plats-group">
                    <legend><?= ucfirst($type) ?><?= $type === 'plat' ? ' principal' : '' ?></legend>

                    <?php if (empty($liste)): ?>
                        <p class="info">Aucun plat disponible</p>
                    <?php else: ?>
                        <?php foreach ($liste as $plat): ?>
                            <label class="checkbox-plat">
                                <input type="checkbox"
                                    name="plats[]"
                                    value="<?= $plat['id'] ?>"
                                    <?= in_array($plat['id'], $platsSelectionnes) ? 'checked' : '' ?>>
                                <?= htmlspecialchars($plat['nom']) ?>
                            </label>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </fieldset>
            <?php endforeach; ?>

            <!-- BOUTON VALIDATION -->
            <button type="submit" class="btn-commande">Enregistrer le menu</button>
            <div class="auth-links">
                <a href="gestion-menus.php">← Retour à la liste des menus</a>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
