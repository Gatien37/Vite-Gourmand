<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Accueil";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1>Chiffre d'affaires</h1>
        <p>Analysez les revenus par période et par menu.</p>
    </section>

    <section class="ca-filtres">
        <form class="ca-filter-form" method="GET">
            <div class="date-field">
                <label for="date-debut">Date de début</label>
                <input type="date" id="date-debut" name="date_debut">
            </div>
            <div class="date-field">
                <label for="date-fin">Date de fin</label>
                <input type="date" id="date-fin" name="date_fin">
            </div>
            <button type="submit" class="btn-commande">Filtrer</button>
        </form>
    </section>

    <section class="ca-summary">
        <div class="ca-card">
            <h3>Total CA</h3>
            <p class="ca-value">12 480 €</p>
        </div>
        <div class="ca-card">
            <h3>Commandes sur la période</h3>
            <p class="ca-value">62</p>
        </div>
        <div class="ca-card">
            <h3>Ticket moyen</h3>
            <p class="ca-value">201 €</p>
        </div>
    </section>

    <section class="ca-table-section">
        <h2>Détail des ventes</h2>
        <div class="table-wrapper">
            <table class="ca-table">
                <thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Menu</th>
                        <th>Quantité</th>
                        <th>Total (€)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- EXEMPLE 1 -->
                    <tr>
                        <td>#CMD-1203</td>
                        <td>12/01/2025</td>
                        <td>Claire M.</td>
                        <td>Menu Festif de Noël</td>
                        <td>6</td>
                        <td>149,40 €</td>
                    </tr>
                    <!-- EXEMPLE 2 -->
                    <tr>
                        <td>#CMD-1194</td>
                        <td>10/01/2025</td>
                        <td>Julien R.</td>
                        <td>Menu Saveurs du Monde</td>
                        <td>4</td>
                        <td>89,60 €</td>
                    </tr>
                    <!-- EXEMPLE 3 -->
                    <tr>
                        <td>#CMD-1187</td>
                        <td>09/01/2025</td>
                        <td>Sophie L.</td>
                        <td>Menu Cocktail Premium</td>
                        <td>10</td>
                        <td>179,90 €</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="ca-graph">
        <div class="graph-card">
            <h2>Évolution du chiffre d'affaires</h2>
            <canvas id="graphCA"></canvas>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
