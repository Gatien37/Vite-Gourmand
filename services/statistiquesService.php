<?php
function buildChiffreAffaireFilter(array $query): array {
    $filter = [];

    if (!empty($query['menu_id'])) {
        $filter['menu_id'] = (int) $query['menu_id'];
    }

    if (!empty($query['date_debut']) && !empty($query['date_fin'])) {
        $filter['jour'] = [
            '$gte' => $query['date_debut'],
            '$lte' => $query['date_fin']
        ];
    }

    return $filter;
}



function calculerStatistiques(array $stats): array
{
    $totalCA = 0;
    $totalCommandes = 0;
    $statsParMenu = [];

    foreach ($stats as $stat) {
        $stat = is_object($stat) ? $stat->getArrayCopy() : $stat;

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

    return [
        'totalCA' => $totalCA,
        'totalCommandes' => $totalCommandes,
        'ticketMoyen' => $totalCommandes > 0
            ? round($totalCA / $totalCommandes, 2)
            : 0,
        'statsParMenu' => $statsParMenu
    ];
}



function getStatistiquesMenus(
    MongoDB\Collection $menuStatsCollection,
    PDO $pdo
): array {

    /* ===== AGRÉGATION MONGODB ===== */
    $pipeline = [
        [
            '$group' => [
                '_id' => '$menu_nom',
                'total_commandes' => ['$sum' => '$nb_commandes']
            ]
        ],
        [
            '$sort' => ['total_commandes' => -1]
        ]
    ];

    $result = $menuStatsCollection->aggregate($pipeline);

    $labels = [];
    $data   = [];

    foreach ($result as $row) {
        $labels[] = $row->_id;
        $data[]   = (int) $row->total_commandes;
    }

    /* ===== TABLE ASSOCIATIVE ===== */
    $statsByMenu = [];
    foreach ($labels as $i => $menuName) {
        $statsByMenu[$menuName] = $data[$i];
    }

    /* ===== MENUS SQL ===== */
    $stmt = $pdo->query("SELECT nom FROM menu ORDER BY nom ASC");
    $allMenus = $stmt->fetchAll(PDO::FETCH_COLUMN);

    return [
        'labels'      => $labels,
        'data'        => $data,
        'statsByMenu' => $statsByMenu,
        'allMenus'    => $allMenus
    ];
}
