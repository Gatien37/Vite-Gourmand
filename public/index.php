<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/avisModel.php';

$avisList = getAvisValides($pdo, 3);
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
        <h1>Traiteur à Bordeaux depuis 25 ans</h1>
        <a href="menus.php" class="button">Découvrir les menus</a>
    </section>

    <section class="histoire">
        <img src="assets/images/histoire.jpg" alt="assortiment de fruits frais">
        <div class="histoire-text">
            <h2>Notre Histoire</h2>
            <p>Depuis plus de 25 ans, Julie et José mettent leur passion de la cuisine au service des familles et des entreprises de la région bordelaise.
                D'un petit atelier artisanal à un véritable service traiteur reconnu, leur savoir-faire s'est construit autour d'une idée simple : proposer des plats
                généreux, préparés avec des produits frais et locaux, et livrés avec une
                exigence de qualité qui ne faiblit jamais.</p><br>
            <p>Au fil des années, Vite & Gourmand est devenu un partenaire de confiance pour les grands événements comme pour les moments du quotidien.Derrière chaque menu,
                il y a l'envie de partager, de simplifier l'organisation, et d'apporter une touche de convivialité à chaque table.</p>
        </div>
    </section>

    <section class="experience">
        <h2>25 ans d'expérience</h2>
        <div class="experience-photos">
            <img src="assets/images/experience1.jpg" alt="José et Julie en cuisine">
            <img src="assets/images/experience2.jpg" alt="plateau de petits fours salés">
            <img src="assets/images/experience3.jpg" alt="seau de bouteilles de champagne">
        </div>
        <div class="experience-icons">
            <div class="icon-item">
                <img src="assets/images/icone_clock.svg" alt="icone horloge">
                <p>Ponctualité</p>
            </div>
            <div class="icon-item">
                <img src="assets/images/icone_check.svg" alt="icone check">
                <p>Frais & local</p>
            </div>
            <div class="icon-item">
                <img src="assets/images/icone_utensils.svg" alt="icone ustensils">
                <p>Savoir-faire artisanal</p>
            </div>
            <div class="icon-item">
                <img src="assets/images/icone_heart.svg" alt="icone coeur">
                <p>Service sur-mesure</p>
            </div>
        </div>
    </section>

<section class="avis">
    <h2>Avis clients</h2>

    <?php if (empty($avisList)): ?>
        <p>Aucun avis client pour le moment.</p>
    <?php else: ?>
        <div class="avis-container">
            <?php foreach ($avisList as $avis): ?>
                <div class="avis-card">

                    <div class="avis-header">
                        <div class="avis-stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <img
                                    src="assets/images/icone_star.svg"
                                    alt="étoile"
                                    class="star <?= $i <= $avis['note'] ? 'active' : '' ?>"
                                >
                            <?php endfor; ?>
                        </div>

                        <h3>
                            <?= htmlspecialchars($avis['prenom']) ?>
                            <?= strtoupper(substr($avis['nom'], 0, 1)) ?>.
                        </h3>
                    </div>

                    <p>
                        “<?= nl2br(htmlspecialchars($avis['commentaire'])) ?>”
                    </p>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="avis-footer">
        <a href="avis.php">Voir tous les avis</a>
    </div>

</section>


    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
