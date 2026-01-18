<?php
require_once __DIR__ . '/../middlewares/requireAdmin.php';
require_once __DIR__ . '/../config/mongo.php';
require_once __DIR__ . '/../config/database.php';

/* =============== AGRÉGATION MONGODB Nombre total de commandes par menu (NoSQL) ====================== */
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

/* =============== PRÉPARATION DES DONNÉES MONGODB ====================== */
$labels = [];
$data   = [];

foreach ($result as $row) {
    $labels[] = $row->_id;
    $data[]   = (int) $row->total_commandes;
}

/* =============== TABLE ASSOCIATIVE ====================== */
$statsByMenu = [];

foreach ($labels as $index => $menuName) {
    $statsByMenu[$menuName] = $data[$index];
}

/* =============== LISTE COMPLÈTE DES MENUS (SQL) ====================== */
$stmt = $pdo->query("SELECT nom FROM menu ORDER BY nom ASC");
$allMenus = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Statistiques";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<!-- Header -->
<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Statistiques générales</h1>
    <p>Analyse des commandes par menu.</p>
</section>

<!-- ===== ACTION ADMIN : SYNCHRONISATION ===== -->
<section class="ca-actions" style="text-align:center; margin-bottom:40px;">
    <a href="../sync/sync_menu_stats.php?redirect=statistiques"
    class="btn-commande"
    onclick="return confirm('Mettre à jour les statistiques ?');">
    Mettre à jour les statistiques
    </a>
</section>

<!-- ================= TABLEAU DES STATISTIQUES ================= -->
<section class="stats-table-section">
    <h2>Nombre de commandes par menu</h2>

    <table class="stats-table">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Nombre de commandes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allMenus as $menuName): ?>
                <tr>
                    <td><?= htmlspecialchars($menuName) ?></td>
                    <td>
                        <?= isset($statsByMenu[$menuName])
                            ? (int) $statsByMenu[$menuName]
                            : 0 ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<!-- ================= GRAPHIQUE ================= -->
<section class="stats-graphs">
    <div class="graph-card">
        <h2>Menus les plus commandés</h2>

        <canvas
            id="graphMenus"
            data-labels='<?= json_encode($labels, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>'
            data-values='<?= json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>'
        ></canvas>
    </div>
</section>

<!-- Footer -->
<?php require_once __DIR__ . '/../partials/footer.php'; ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/vite-gourmand/public/assets/js/stats.js"></script>

</body>
</html>
