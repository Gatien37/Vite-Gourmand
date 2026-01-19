<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/horaireModel.php';
require_once __DIR__ . '/../services/horaireService.php';

/* ========= DONNÉES ========= */
$horaires = getHoraires($pdo);

/* ========= TRAITEMENT FORMULAIRE ========= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    traiterMiseAJourHoraires($pdo, $horaires, $_POST);
    header('Location: gestion-horaires.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Gestion des horaires";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Gestion des horaires</h1>
    <p>Modifiez les horaires affichés sur le site.</p>
</section>

<section class="horaires-form-container">
    <form method="POST" class="horaires-form form-card">
        <h2>Horaires d'ouverture</h2>

        <?php foreach ($horaires as $h): ?>
            <div class="jour">
                <label><?= ucfirst($h['jour']) ?></label>

                <input
                    type="time"
                    name="<?= $h['jour'] ?>_ouverture"
                    value="<?= htmlspecialchars($h['ouverture'] ?? '') ?>"
                >

                <input
                    type="time"
                    name="<?= $h['jour'] ?>_fermeture"
                    value="<?= htmlspecialchars($h['fermeture'] ?? '') ?>"
                >
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn-commande">
            Enregistrer les horaires
        </button>

        <div class="auth-links">
            <a href="espace-employe.php">← Retour au tableau de bord</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
