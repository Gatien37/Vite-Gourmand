<?php
/* ========= ENDPOINT AJAX : FILTRAGE MENUS ========= */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';
require_once __DIR__ . '/../services/menuService.php';

/* ========= Filtres ========= */
$filters = buildMenuFilters($_GET);

/* ========= Données ========= */
$menus = getFilteredMenus($pdo, $filters);

/* ========= Rendu partiel ========= */
if (empty($menus)) {
    echo '<p class="no-result">Aucun menu ne correspond à cette recherche.</p>';
    exit;
}

foreach ($menus as $menu) {
    require __DIR__ . '/../partials/menu-card.php';
}
