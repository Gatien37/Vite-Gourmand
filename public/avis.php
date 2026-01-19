<?php
/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/avisModel.php';

/* ========== Récupération des avis validés ========== */

$avisList = getAvisValides($pdo, 50);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées de la page ========== */
    $title = "Avis clients";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<section class="avis">
    <h2>Tous les avis clients</h2>

    <?php if (empty($avisList)): ?>

        <p>Aucun avis client pour le moment.</p>

    <?php else: ?>

        <div class="avis-container">
            <?php foreach ($avisList as $avis): ?>

                <article class="avis-card">

                    <!-- Note + auteur -->
                    <header class="avis-header">
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
                    </header>

                    <!-- Commentaire -->
                    <p class="avis-commentaire">
                        “<?= nl2br(htmlspecialchars($avis['commentaire'])) ?>”
                    </p>

                </article>

            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</section>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
