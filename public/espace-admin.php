<?php
require_once __DIR__ . '/../middlewares/requireAdmin.php';
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Espace Administrateur";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1>Espace Administrateur</h1>
        <p>Pilotez l'activité globale de Vite & Gourmand.</p>
    </section>

    <section class="admin-dashboard-container">
        <!-- GESTION EMPLOYÉS -->
        <div class="dashboard-card">
            <h3>👥 Gestion des employés</h3>
            <p>Ajoutez, modifiez ou supprimez des comptes employés.</p>
            <a href="gestion-employes.php" class="btn-commande">Gérer les employés</a>
        </div>
        <!-- STATISTIQUES -->
        <div class="dashboard-card">
            <h3>📊 Statistiques</h3>
            <p>Visualisez les performances : ventes, menus populaires, avis…</p>
            <a href="statistiques.php" class="btn-commande">Voir les statistiques</a>
        </div>
        <!-- CHIFFRE D'AFFAIRES -->
        <div class="dashboard-card">
            <h3>💰 Chiffre d'affaires</h3>
            <p>Consultez les revenus et filtrez par période ou par menu.</p>
            <a href="chiffre-affaire.php" class="btn-commande">Voir le CA</a>
        </div>
        <!-- ACCÈS AUX FONCTIONS EMPLOYÉ  -->
        <div class="dashboard-card">
            <h3>📋 Menus</h3>
            <p>Accédez à la gestion des menus.</p>
            <a href="gestion-menus.php" class="btn-secondary">Gestion des menus</a>
        </div>
        <div class="dashboard-card">
            <h3>📦 Commandes</h3>
            <p>Suivez et modifiez l'état des commandes en cours.</p>
            <a href="gestion-commandes.php" class="btn-secondary">Gestion des commandes</a>
        </div>
        <div class="dashboard-card">
            <h3>⭐ Avis</h3>
            <p>Validez ou refusez les avis laissés par les clients.</p>
            <a href="gestion-avis.php" class="btn-secondary">Gestion des avis</a>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
