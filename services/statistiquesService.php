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
    /* ========== Initialisation des totaux ========== */
    $totalCA = 0;
    $totalCommandes = 0;
    $statsParMenu = [];

    /* ========== Parcours des statistiques ========== */
    foreach ($stats as $stat) {

        /* MongoDB peut retourner des objets BSON */
        $stat = is_object($stat)
            ? $stat->getArrayCopy()
            : $stat;

        /* ========== Sécurisation des valeurs ========== */
        $ca = $stat['chiffre_affaires'] ?? 0;
        $nb = $stat['nb_commandes'] ?? 0;

        /* ========== Cumul global ========== */
        $totalCA += $ca;
        $totalCommandes += $nb;

        /* ========== Détail par menu ========== */
        $statsParMenu[] = [
            'menu_nom' => $stat['menu_nom'] ?? 'Menu inconnu',
            'nb_commandes' => $nb,
            'chiffre_affaires' => $ca
        ];
    }

    /* ========== Calcul du ticket moyen ========== */
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


/* =====================================================
   STATISTIQUES COMMANDES PAR MENU
   MongoDB (agrégation) + SQL (référentiel)
   ===================================================== */

function getStatistiquesMenus(
    MongoDB\Collection $menuStatsCollection,
    PDO $pdo
): array {

    /* ========== AGRÉGATION MONGODB ========== */
    $pipeline = [
        [
            '$match' => [
                'nb_commandes' => ['$exists' => true]
            ]
        ],
        [
            '$group' => [
                '_id' => '$menu_nom',
                'total_commandes' => [
                    '$sum' => [
                        '$cond' => [
                            ['$isNumber' => '$nb_commandes'],
                            '$nb_commandes',
                            0
                        ]
                    ]
                ]
            ]
        ],
        [
            '$sort' => ['total_commandes' => -1]
        ]
    ];



    $result = $menuStatsCollection->aggregate($pipeline);

    /* ========== Préparation des données graphiques ========== */
    $labels = [];
    $data   = [];

    foreach ($result as $row) {
        $labels[] = $row->_id;
        $data[]   = (int) $row->total_commandes;
    }

    /* ========== Association menu => nombre de commandes ========== */
    $statsByMenu = [];
    foreach ($labels as $i => $menuName) {
        $statsByMenu[$menuName] = $data[$i];
    }

    /* ========== Récupération de tous les menus (SQL) ========== */
    $stmt = $pdo->query("
        SELECT nom
        FROM menu
        ORDER BY nom ASC
    ");
    $allMenus = $stmt->fetchAll(PDO::FETCH_COLUMN);

    return [
        'labels'      => $labels,
        'data'        => $data,
        'statsByMenu' => $statsByMenu,
        'allMenus'    => $allMenus
    ];
}
