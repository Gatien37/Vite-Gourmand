<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';
require_once __DIR__ . '/../services/menuService.php';

/* ========= FILTRES (chargement initial uniquement) ========= */
$filters = buildMenuFilters($_GET);

/* ========= DONNÉES INITIALES ========= */
$menus = getFilteredMenus($pdo, $filters);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Menus";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main id="main-content">

    <!-- ===== HERO ===== -->
    <section class="hero-section commandes-hero">
        <h1>Tous nos menus</h1>
        <p>Trouvez facilement le menu adapté à votre événement.</p>
    </section>

    <!-- ===== FILTRES ===== -->
    <form class="filtres" id="filters-form">

        <select name="theme" class="filtre-btn filtre-visible">
            <option value="">Thèmes</option>
            <option value="noel" <?= ($_GET['theme'] ?? '') === 'noel' ? 'selected' : '' ?>>Noël</option>
            <option value="paques" <?= ($_GET['theme'] ?? '') === 'paques' ? 'selected' : '' ?>>Pâques</option>
            <option value="evenement" <?= ($_GET['theme'] ?? '') === 'evenement' ? 'selected' : '' ?>>Événement</option>
            <option value="classique" <?= ($_GET['theme'] ?? '') === 'classique' ? 'selected' : '' ?>>Classique</option>
        </select>

        <!-- bouton mobile (UI uniquement) -->
        <button type="button" class="filtre-btn" id="toggle-filtres">
            Filtres avancés
        </button>

        <!-- filtres secondaires -->
        <div class="filtres-avances" id="filtres-avances">

            <select name="regime" class="filtre-btn">
                <option value="">Régimes</option>
                <option value="vegan" <?= ($_GET['regime'] ?? '') === 'vegan' ? 'selected' : '' ?>>Vegan</option>
                <option value="vegetarien" <?= ($_GET['regime'] ?? '') === 'vegetarien' ? 'selected' : '' ?>>Végétarien</option>
                <option value="classique" <?= ($_GET['regime'] ?? '') === 'classique' ? 'selected' : '' ?>>Classique</option>
            </select>

            <select name="prix_max" class="filtre-btn">
                <option value="">Prix max</option>
                <option value="15" <?= ($_GET['prix_max'] ?? '') === '15' ? 'selected' : '' ?>>15€</option>
                <option value="25" <?= ($_GET['prix_max'] ?? '') === '25' ? 'selected' : '' ?>>25€</option>
                <option value="30" <?= ($_GET['prix_max'] ?? '') === '30' ? 'selected' : '' ?>>30€</option>
            </select>

            <select name="fourchette_prix" class="filtre-btn">
                <option value="">Fourchette de prix</option>
                <option value="10-20" <?= ($_GET['fourchette_prix'] ?? '') === '10-20' ? 'selected' : '' ?>>entre 10€ et 20€</option>
                <option value="20-30" <?= ($_GET['fourchette_prix'] ?? '') === '20-30' ? 'selected' : '' ?>>entre 20€ et 30€</option>
            </select>

            <select name="nb_personnes_min" class="filtre-btn">
                <option value="">Personnes min</option>
                <option value="4" <?= ($_GET['nb_personnes_min'] ?? '') === '4' ? 'selected' : '' ?>>4</option>
                <option value="6" <?= ($_GET['nb_personnes_min'] ?? '') === '6' ? 'selected' : '' ?>>6</option>
                <option value="8" <?= ($_GET['nb_personnes_min'] ?? '') === '8' ? 'selected' : '' ?>>8</option>
            </select>

        </div>
    </form>

    <!-- ===== LISTE DES MENUS ===== -->
    <section class="menus-list" id="menus-list">

        <?php if (empty($menus)): ?>

            <p class="no-result">
                Aucun menu ne correspond à cette recherche.
            </p>

        <?php else: ?>

            <?php foreach ($menus as $menu): ?>
                <?php require __DIR__ . '/../partials/menu-card.php'; ?>
            <?php endforeach; ?>

        <?php endif; ?>

    </section>

</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>


</body>
</html>
