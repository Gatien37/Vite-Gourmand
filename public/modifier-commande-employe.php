<?php
/* ========== Chargement des middlewares et dépendances ========== */

require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';
require_once __DIR__ . '/../services/commandeService.php';

/* ========== Génération du token CSRF ========== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ========== Validation de l’identifiant de commande ========== */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: gestion-commandes.php');
    exit;
}

$commandeId = (int) $_GET['id'];

/* ========== Récupération de la commande modifiable ========== */

$commande = getCommandeEditableParEmploye($pdo, $commandeId);

if (!$commande) {
    header('Location: gestion-commandes.php');
    exit;
}

/* ========== Préparation des données de date ========== */

$date = new DateTime($commande['date_prestation']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Modifier commande - employé";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <!-- ===== Titre de la page ===== -->
    <section class="hero-section commandes-hero">
        <h1>Modifier la commande #CMD-<?= (int) $commande['id'] ?></h1>
        <p>Modification suite à contact client</p>
    </section>

    <section class="order-detail-container">
        <div class="order-card">

            <!-- ===== Formulaire de modification de commande ===== -->
            <form
                method="POST"
                action="traiter-modification-commande.php"
                class="form-card"
            >

                <!-- CSRF -->
                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= $_SESSION['csrf_token'] ?>"
                >

                <!-- Identifiant de la commande -->
                <input
                    type="hidden"
                    name="commande_id"
                    value="<?= (int) $commande['id'] ?>"
                >

                <!-- Menu (lecture seule) -->
                <p class="menu-readonly">
                    <?= htmlspecialchars($commande['menu_nom']) ?>
                </p>

                <!-- Date de prestation -->
                <label for="date">Date *</label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    value="<?= $date->format('Y-m-d') ?>"
                    required
                >

                <!-- Heure de prestation -->
                <label for="heure">Heure *</label>
                <input
                    type="time"
                    name="heure"
                    id="heure"
                    value="<?= $date->format('H:i') ?>"
                    required
                >

                <!-- Quantité -->
                <label for="quantite">Nombre de personnes *</label>
                <input
                    type="number"
                    name="quantite"
                    id="quantite"
                    min="1"
                    value="<?= (int) $commande['quantite'] ?>"
                    required
                >

                <!-- Adresse -->
                <label for="adresse">Adresse *</label>
                <input
                    type="text"
                    name="adresse"
                    id="adresse"
                    value="<?= htmlspecialchars($commande['adresse'] ?? '') ?>"
                    required
                >

                <!-- Ville -->
                <label for="ville">Ville *</label>
                <input
                    type="text"
                    name="ville"
                    id="ville"
                    value="<?= htmlspecialchars($commande['ville'] ?? '') ?>"
                    required
                >

                <button type="submit" class="btn-commande">
                    Enregistrer les modifications
                </button>

            </form>

            <!-- Retour au détail de la commande -->
            <a
                href="commande-detail-employe.php?id=<?= $commandeId ?>"
                class="btn-secondary"
            >
                ← Retour au détail
            </a>

        </div>
    </section>
</main>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
