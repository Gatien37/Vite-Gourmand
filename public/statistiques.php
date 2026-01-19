<?php
require_once __DIR__ . '/../middlewares/requireAdmin.php';
require_once __DIR__ . '/../config/mongo.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../services/statistiquesService.php';

/* ===== RÉCUPÉRATION DES DONNÉES ===== */
$stats = getStatistiquesMenus($menuStatsCollection, $pdo);

$labels      = $stats['labels'];
$data        = $stats['data'];
$statsByMenu = $stats['statsByMenu'];
$allMenus    = $stats['allMenus'];
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

<main id="main-content">

    <section class="hero-section commandes-hero">
        <h1>Statistiques générales</h1>
        <p>Analyse des commandes par menu.</p>
    </section>

    <!-- ===== ACTION ADMIN : SYNCHRONISATION ===== -->
    <section class="ca-actions">
        <a
            href="../sync/sync_menu_stats.php?redirect=statistiques"
            class="btn-commande js-confirm-sync"
        >
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
                        <td><?= $statsByMenu[$menuName] ?? 0 ?></td>
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
</main>

<!-- Footer -->
<?php require_once __DIR__ . '/../partials/footer.php'; ?>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/vite-gourmand/public/assets/js/stats.js"></script>

</body>
</html>
