<?php
/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Espace Utilisateur";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <main id="main-content">

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

        </section>
    </main>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
