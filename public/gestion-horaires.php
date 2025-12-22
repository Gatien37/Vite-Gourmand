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
        <h1>Gestion des horaires</h1>
        <p>Modifiez les horaires affichés sur le site.</p>
    </section>

    <section class="horaires-form-container">

        <form class="horaires-form" action="#" method="POST">
            <h2>Horaires d'ouverture</h2>
            <div class="jour">
                <label for="lundi">Lundi</label>
                <input type="text" id="lundi" name="lundi" placeholder="Ex : 9h - 18h">
            </div>
            <div class="jour">
                <label for="mardi">Mardi</label>
                <input type="text" id="mardi" name="mardi" placeholder="Ex : 9h - 18h">
            </div>
            <div class="jour">
                <label for="mercredi">Mercredi</label>
                <input type="text" id="mercredi" name="mercredi" placeholder="Ex : 9h - 18h">
            </div>
            <div class="jour">
                <label for="jeudi">Jeudi</label>
                <input type="text" id="jeudi" name="jeudi" placeholder="Ex : 9h - 18h">
            </div>
            <div class="jour">
                <label for="vendredi">Vendredi</label>
                <input type="text" id="vendredi" name="vendredi" placeholder="Ex : 9h - 18h">
            </div>
            <div class="jour">
                <label for="samedi">Samedi</label>
                <input type="text" id="samedi" name="samedi" placeholder="Ex : 10h - 14h">
            </div>
            <div class="jour">
                <label for="dimanche">Dimanche</label>
                <input type="text" id="dimanche" name="dimanche" placeholder="Ex : Fermé">
            </div>
            <button type="submit" class="btn-commande">Enregistrer les horaires</button>
            <div class="auth-links">
                <a href="espace-employe.php">← Retour au tableau de bord</a>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
