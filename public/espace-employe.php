<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
?>


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
        <h1>Tableau de bord employé</h1>
        <p>Gérez les menus, commandes, avis et horaires.</p>
    </section>

    <section class="employe-dashboard-container">
        <!-- GESTION DES MENUS -->
        <div class="dashboard-card">
            <h3>📋 Menus</h3>
            <p>Créer, modifier ou supprimer les menus proposés.</p>
            <a href="gestion-menus.php" class="btn-commande">Gérer les menus</a>
        </div>
        <!-- GESTION DES PLATS -->
        <div class="dashboard-card">
            <h3>🍽️ Plats</h3>
            <p>Gérez les plats disponibles pour les menus.</p>
            <a href="gestion-plats.php" class="btn-commande">Gérer les plats</a>
        </div>
        <!-- GESTION DES COMMANDES -->
        <div class="dashboard-card">
            <h3>📦 Commandes</h3>
            <p>Consultez et mettez à jour les commandes des clients.</p>
            <a href="gestion-commandes.php" class="btn-commande">Gérer les commandes</a>
        </div>
        <!-- GESTION DES AVIS -->
        <div class="dashboard-card">
            <h3>⭐ Avis</h3>
            <p>Validez, refusez ou modérez les avis clients.</p>
            <a href="gestion-avis.php" class="btn-commande">Gérer les avis</a>
        </div>
        <!-- GESTION DES HORAIRES -->
        <div class="dashboard-card">
            <h3>🕒 Horaires</h3>
            <p>Modifier les horaires d'ouverture affichés sur le site.</p>
            <a href="gestion-horaires.php" class="btn-commande">Modifier les horaires</a>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
