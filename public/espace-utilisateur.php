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

    <section class="dashboard-container">

        <!-- BLOC PROFIL -->
        <div class="dashboard-card">
            <h2>Mes informations</h2>
            <p>Consultez ou modifiez vos données personnelles.</p>
            <a href="profil.php" class="btn-commande">Voir mon profil</a>
        </div>

        <!-- BLOC COMMANDES -->
        <div class="dashboard-card">
            <h2>Mes commandes</h2>
            <p>Suivez vos commandes passées et en cours.</p>
            <a href="commande-utilisateur.php" class="btn-commande">Voir mes commandes</a>
        </div>

        <!-- BLOC AVIS -->
        <div class="dashboard-card">
            <h2>Mes avis</h2>
            <p>Laissez un avis sur vos commandes.</p>
            <a href="laisser-un-avis.php" class="btn-commande">Laisser un avis</a>
        </div>

    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
