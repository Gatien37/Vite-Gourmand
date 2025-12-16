<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Accueil";
    require_once __DIR__ . '/partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1>Statistiques générales</h1>
        <p>Analysez les performances de Vite & Gourmand.</p>
    </section>

    <section class="stats-summary">
        <div class="stats-card">
            <h3>📦 Commandes totales</h3>
            <p class="stats-value">1245</p>
        </div>
        <div class="stats-card">
            <h3>💶 Chiffre d'affaires total</h3>
            <p class="stats-value">48 320 €</p>
        </div>
        <div class="stats-card">
            <h3>🍽️ Menu le plus vendu</h3>
            <p class="stats-value">Menu Festif de Noël</p>
        </div>
        <div class="stats-card">
            <h3>⭐ Note moyenne clients</h3>
            <p class="stats-value">4.6 / 5</p>
        </div>
    </section>

    <section class="stats-graphs">
        <div class="graph-card">
            <h2>Évolution des ventes</h2>
            <canvas id="graphVentes"></canvas>
        </div>
        <div class="graph-card">
            <h2>Menus les plus populaires</h2>
            <canvas id="graphMenus"></canvas>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
