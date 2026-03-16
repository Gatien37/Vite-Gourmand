<?php
/* =====================================================
   FILTRES & STATISTIQUES CHIFFRE D’AFFAIRES
   SQL + MongoDB
   ===================================================== */


/* ========== Construction du filtre MongoDB ========== */

function buildChiffreAffaireFilter(array $query): array
{
    $filter = [];

    /* ========== Filtre par menu ========== */
    if (!empty($query['menu_id'])) {
        $filter['menu_id'] = (int) $query['menu_id'];
    }

    /* ========== Filtre par période (dates) ========== */
    if (!empty($query['date_debut']) && !empty($query['date_fin'])) {
        $filter['jour'] = [
            '$gte' => $query['date_debut'],
            '$lte' => $query['date_fin']
        ];
    }

    return $filter;
}


/* =====================================================
   CALCUL DES STATISTIQUES GLOBALES
   ===================================================== */

function calculerStatistiques(array $stats): array
{
    $totalCA = 0;
    $totalCommandes = 0;
    $statsParMenu = [];

    foreach ($stats as $stat) {

        $stat = is_object($stat)
            ? $stat->getArrayCopy()
            : $stat;

        $ca = $stat['chiffre_affaires'] ?? 0;
        $nb = $stat['nb_commandes'] ?? 0;

        $totalCA += $ca;
        $totalCommandes += $nb;

        $statsParMenu[] = [
            'menu_nom' => $stat['menu_nom'] ?? 'Menu inconnu',
            'nb_commandes' => $nb,
            'chiffre_affaires' => $ca
        ];
    }

    $ticketMoyen = $totalCommandes > 0
        ? round($totalCA / $totalCommandes, 2)
        : 0;

    return [
        'totalCA' => $totalCA,
        'totalCommandes' => $totalCommandes,
        'ticketMoyen' => $ticketMoyen,
        'statsParMenu' => $statsParMenu
    ];
}



function formaterStatistiquesMenus(array $stats, array $allMenus): array
{
    $labels = [];
    $data = [];

    foreach ($stats as $row) {
        $row = is_object($row) ? $row->getArrayCopy() : $row;

        $labels[] = $row['_id'];
        $data[]   = (int) $row['nb_commandes'];
    }

    $statsByMenu = [];

    foreach ($allMenus as $menuName) {
        $statsByMenu[$menuName] = 0;
    }

    foreach ($labels as $i => $menuName) {
        $statsByMenu[$menuName] = $data[$i];
    }

    return [
        'labels' => $labels,
        'data' => $data,
        'statsByMenu' => $statsByMenu,
        'allMenus' => $allMenus
    ];
}