<?php

/* ========== Sécurisation : accès Admin ========== */

require_once __DIR__ . '/../middlewares/requireAdmin.php';

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/mongo.php';
require_once __DIR__ . '/../services/statistiquesService.php';

/* ========== Filtres (GET) ========== */

$filter = buildChiffreAffaireFilter($_GET);

/* ========== Données chiffre d'affaires (MongoDB) ========== */

$cursor = $menuStatsCollection->find($filter);
$stats = iterator_to_array($cursor);

/* ========== Calculs statistiques (service) ========== */

$resultats = calculerStatistiques($stats);

$totalCA         = $resultats['totalCA'];
$totalCommandes  = $resultats['totalCommandes'];
$ticketMoyen     = $resultats['ticketMoyen'];
$statsParMenu    = $resultats['statsParMenu'];

/* ========== Menus disponibles (SQL) ========== */

$stmt = $pdo->query("SELECT id, nom FROM menu ORDER BY nom ASC");
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées de la page ========== */
    $title = "Chiffre d'affaires";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<!-- ===== Titre de la page ===== -->
<section class="hero-section commandes-hero">
    <h1>Chiffre d'affaires</h1>
    <p>Analysez les revenus par période et par menu.</p>
</section>

<!-- ===== Action admin : synchronisation des statistiques ===== -->
<section class="ca-actions">
    <a
        href="../sync/sync_menu_stats.php?redirect=chiffre-affaire"
        class="btn-commande js-confirm-sync"
    >
        Mettre à jour les statistiques
    </a>
</section>

<!-- ===== Filtres ===== -->
<section class="ca-filtres">
    <form class="ca-filter-form" method="GET">

        <div class="menu-field">
            <label for="menu_id">Menu</label>
            <select name="menu_id" id="menu_id">
                <option value="">Tous les menus</option>

                <?php foreach ($menus as $menu): ?>
                    <option
                        value="<?= (int) $menu['id'] ?>"
                        <?= (!empty($_GET['menu_id']) && $_GET['menu_id'] == $menu['id']) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($menu['nom']) ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>

        <div class="date-field">
            <label for="date_debut">Date de début</label>
            <input
                type="date"
                name="date_debut"
                value="<?= $_GET['date_debut'] ?? '' ?>"
            >
        </div>

        <div class="date-field">
            <label for="date_fin">Date de fin</label>
            <input
                type="date"
                name="date_fin"
                value="<?= $_GET['date_fin'] ?? '' ?>"
            >
        </div>

        <button type="submit" class="btn-commande">
            Filtrer
        </button>

    </form>
</section>

<!-- ===== Résumé chiffre d'affaires ===== -->
<section class="ca-summary">

    <div class="ca-card">
        <h3>Total CA</h3>
        <p class="ca-value">
            <?= number_format($totalCA, 2, ',', ' ') ?> €
        </p>
    </div>

    <div class="ca-card">
        <h3>Commandes sur la période</h3>
        <p class="ca-value">
            <?= (int) $totalCommandes ?>
        </p>
    </div>

</section>

<!-- ===== Tableau détaillé ===== -->
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
                        <td colspan="3">
                            Aucune donnée pour la période sélectionnée
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($statsParMenu as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['menu_nom']) ?></td>
                            <td><?= (int) $row['nb_commandes'] ?></td>
                            <td>
                                <?= number_format($row['chiffre_affaires'], 2, ',', ' ') ?> €
                            </td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
