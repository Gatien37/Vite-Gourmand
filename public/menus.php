<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';
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
            <h1>Tous nos menus</h1>
            <p>Trouvez facilement le menu adapté à votre événement.</p>
    </section>

    <!-- Filtres -->

    <?php
        $filters = [
        'theme' => $_GET['theme'] ?? null,
        'regime' => $_GET['regime'] ?? null,
        'nb_personnes_min' => $_GET['nb_personnes_min'] ?? null,
        'prix_max' => $_GET['prix_max'] ?? null,
        'fourchette_prix' => $_GET['fourchette_prix'] ?? null,
    ];
    $menus = getFilteredMenus($pdo, $filters);
    ?>

    <form method="GET" class="filtres">

    <select name="theme" class="filtre-btn filtre-visible">
        <option value="">Thèmes</option>
        <option value="noel">Noël</option>
        <option value="paques">Pâques</option>
        <option value="evenement">Événement</option>
        <option value="classique">Classique</option>
    </select>

    <!-- bouton mobile -->
    <button type="button" class="filtre-btn" id="toggle-filtres">
        Filtres avancés
    </button>

    <!-- filtres secondaires -->
    <div class="filtres-avances" id="filtres-avances">

        <select name="regime" class="filtre-btn">
            <option value="">Régimes</option>
            <option value="vegan">Vegan</option>
            <option value="vegetarien">Végétarien</option>
            <option value="classique">Classique</option>
        </select>

        <select name="prix_max" class="filtre-btn">
            <option value="">Prix max</option>
            <option value="15">15€</option>
            <option value="25">25€</option>
            <option value="30">30€</option>
        </select>

        <select name="fourchette_prix" class="filtre-btn">
            <option value="">Fourchette de prix</option>
            <option value="10-20">entre 10€ et 20€</option>
            <option value="20-30">entre 20€ et 30€</option>
        </select>

        <select name="nb_personnes_min" class="filtre-btn">
            <option value="">Personnes min</option>
            <option value="4">4</option>
            <option value="6">6</option>
            <option value="8">8</option>
        </select>

    </div>

    <button type="submit" class="filtre-appliquer">
        Appliquer
    </button>
</form>

    <!-- Liste des menus -->

<section class="menus-list">

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


    
    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>