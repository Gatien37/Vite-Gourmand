<?php
/* ========== Sécurité : accès employé ou administrateur ========== */

require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/horaireModel.php';
require_once __DIR__ . '/../services/horaireService.php';

/* ========== Récupération des horaires ========== */

$horaires = getHoraires($pdo);

/* ========== Traitement du formulaire ========== */

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
    /* ========== Métadonnées ========== */
    $title = "Gestion des horaires";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <!-- ===== Titre ===== -->
    <section class="hero-section commandes-hero">
        <h1>Gestion des horaires</h1>
        <p>Modifiez les horaires affichés sur le site.</p>
    </section>

    <section class="horaires-form-container">

        <!-- ===== Formulaire des horaires ===== -->
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

            <!-- Bouton validation -->
            <button type="submit" class="btn-commande">
                Enregistrer les horaires
            </button>

            <!-- Lien retour -->
            <div class="auth-links">
                <a href="espace-employe.php">← Retour au tableau de bord</a>
            </div>

        </form>
    </section>
</main>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
