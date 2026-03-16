<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/mongo.php';

require_once __DIR__ . '/../services/statistiquesService.php';

require_once __DIR__ . '/../repositories/mongo/StatistiqueMongoRepository.php';
require_once __DIR__ . '/../repositories/sql/menuRepository.php';


function handleStatistiquesMenus(): array
{
    global $pdo, $menuStatsCollection;

    $mongoRepository = new StatistiqueMongoRepository($menuStatsCollection);

    $stats = $mongoRepository->aggregateMenus();
    $allMenus = getMenuNames($pdo);

    return formaterStatistiquesMenus($stats, $allMenus);
}


function handleChiffreAffaire(array $query): array
{
    global $pdo, $menuStatsCollection;

    $mongoRepository = new StatistiqueMongoRepository($menuStatsCollection);

    $filter = buildChiffreAffaireFilter($query);
    $stats = $mongoRepository->findByFilter($filter);
    $resultats = calculerStatistiques($stats);

    $menus = getAllMenus($pdo);

    return [
        'totalCA' => $resultats['totalCA'],
        'totalCommandes' => $resultats['totalCommandes'],
        'ticketMoyen' => $resultats['ticketMoyen'],
        'statsParMenu' => $resultats['statsParMenu'],
        'menus' => $menus
    ];
}