<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/mongo.php';

/* ===========  MENUS (SQL) =========== */
$stmt = $pdo->query("SELECT id, nom FROM menu ORDER BY nom ASC");
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ===========  FILTRES MONGODB =========== */
$filter = [];

if (!empty($_GET['menu_id'])) {
    $filter['menu_id'] = (int) $_GET['menu_id'];
}

if (!empty($_GET['date_debut']) && !empty($_GET['date_fin'])) {
    $filter['jour'] = [
        '$gte' => $_GET['date_debut'],
        '$lte' => $_GET['date_fin']
    ];
}

/* ===========  DONNÉES CA (NoSQL) =========== */
$cursor = $menuStatsCollection->find($filter);
$stats = iterator_to_array($cursor);

/* ===========  CALCULS =========== */
$totalCA = 0;
$totalCommandes = 0;
$statsParMenu = [];

foreach ($stats as $stat) {

    $stat = $stat->getArrayCopy();

    $chiffreAffaires = $stat['chiffre_affaires'] ?? 0;
    $nbCommandes     = $stat['nb_commandes'] ?? 0;
    $menuNom         = $stat['menu_nom'] ?? 'Menu inconnu';

    $totalCA += $chiffreAffaires;
    $totalCommandes += $nbCommandes;

    $statsParMenu[] = [
        'menu_nom' => $menuNom,
        'nb_commandes' => $nbCommandes,
        'chiffre_affaires' => $chiffreAffaires
    ];
}

$ticketMoyen = $totalCommandes > 0
    ? round($totalCA / $totalCommandes, 2)
    : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Chiffre d'affaires";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Chiffre d'affaires</h1>
    <p>Analysez les revenus par période et par menu.</p>
</section>

<!-- ===== ACTION ADMIN : SYNCHRONISATION ===== -->
<section class="ca-actions" style="text-align:center; margin-bottom:40px;">
    <a href="../sync/sync_menu_stats.php"
    class="btn-commande"
    onclick="return confirm('Mettre à jour les statistiques ?');">
    Mettre à jour les statistiques
    </a>
</section>

<section class="ca-filtres">
    <form class="ca-filter-form" method="GET">

        <div class="menu-field">
            <label for="menu_id">Menu</label>
            <select name="menu_id" id="menu_id">
                <option value="">Tous les menus</option>
                <?php foreach ($menus as $menu): ?>
                    <option value="<?= (int) $menu['id'] ?>"
                        <?= (!empty($_GET['menu_id']) && $_GET['menu_id'] == $menu['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($menu['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="date-field">
            <label for="date_debut">Date de début</label>
            <input type="date" name="date_debut" value="<?= $_GET['date_debut'] ?? '' ?>">
        </div>

        <div class="date-field">
            <label for="date_fin">Date de fin</label>
            <input type="date" name="date_fin" value="<?= $_GET['date_fin'] ?? '' ?>">
        </div>

        <button type="submit" class="btn-commande">Filtrer</button>
    </form>
</section>

<section class="ca-summary">
    <div class="ca-card">
        <h3>Total CA</h3>
        <p class="ca-value"><?= number_format($totalCA, 2, ',', ' ') ?> €</p>
    </div>

    <div class="ca-card">
        <h3>Commandes sur la période</h3>
        <p class="ca-value"><?= $totalCommandes ?></p>
    </div>
</section>

<section class="ca-table-section">
    <h2>Détail des ventes par menu</h2>

    <div class="table-wrapper">
        <table class="ca-table">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Nombre de commandes</th>
                    <th>Chiffre d'affaires (€)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($statsParMenu)): ?>
                    <tr>
                        <td colspan="3">Aucune donnée pour la période sélectionnée</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($statsParMenu as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['menu_nom']) ?></td>
                            <td><?= (int) $row['nb_commandes'] ?></td>
                            <td><?= number_format($row['chiffre_affaires'], 2, ',', ' ') ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
