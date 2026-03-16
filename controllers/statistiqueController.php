<?php

require_once __DIR__ . '/../config/services.php';
require_once __DIR__ . '/../config/mongo.php';
require_once __DIR__ . '/../services/statistiquesService.php';
require_once __DIR__ . '/../repositories/mongo/StatistiqueMongoRepository.php';

function handleStatistiquesMenus(): array
{
    global $menuStatsCollection, $menuRepository;

    $mongoRepository = new StatistiqueMongoRepository($menuStatsCollection);
    $stats = $mongoRepository->aggregateMenus();
    $allMenus = $menuRepository->getMenuNames();

    return formaterStatistiquesMenus($stats, $allMenus);
}

function handleChiffreAffaire(array $query): array
{
    global $menuStatsCollection, $menuRepository;

    $mongoRepository = new StatistiqueMongoRepository($menuStatsCollection);
    $filter = buildChiffreAffaireFilter($query);
    $stats = $mongoRepository->findByFilter($filter);
    $resultats = calculerStatistiques($stats);
    $menus = $menuRepository->getAllMenus();

    return [
        'totalCA' => $resultats['totalCA'],
        'totalCommandes' => $resultats['totalCommandes'],
        'ticketMoyen' => $resultats['ticketMoyen'],
        'statsParMenu' => $resultats['statsParMenu'],
        'menus' => $menus
    ];
}