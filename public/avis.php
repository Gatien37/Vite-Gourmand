<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/avisModel.php';

$avisList = getAvisValides($pdo, 50);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Avis clients";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="avis">
    <h2>Tous les avis clients</h2>

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
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>

