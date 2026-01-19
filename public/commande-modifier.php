<?php
/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';


/* ========== Sécurisation de la méthode HTTP ========== */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Récupération des données ========== */

$commandeId = (int) ($_POST['commande_id'] ?? 0);
$userId     = (int) $_SESSION['user']['id'];

/* ========== Récupération de la commande ========== */

$commande = getCommandeById($pdo, $commandeId);

/* ========== Sécurité : propriété de la commande ========== */

if (!$commande || (int) $commande['utilisateur_id'] !== $userId) {
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Règle métier : annulation autorisée uniquement si en attente ========== */

if ($commande['statut'] !== 'en_attente') {
    $_SESSION['error'] = "Impossible d'annuler : commande déjà traitée.";
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Traitement de l'annulation ========== */

try {
    $pdo->beginTransaction();

    // Mise à jour du statut de la commande
    $stmtUpdate = $pdo->prepare("
        UPDATE commande
        SET statut = 'annulee'
        WHERE id = :id
    ");
    $stmtUpdate->execute(['id' => $commandeId]);

    // Ajout dans l'historique de suivi
    $stmtSuivi = $pdo->prepare("
        INSERT INTO commande_suivi (commande_id, statut)
        VALUES (:commande_id, 'annulee')
    ");
    $stmtSuivi->execute(['commande_id' => $commandeId]);

    // Restitution du stock du menu
    $stmtStock = $pdo->prepare("
        UPDATE menu
        SET stock = stock + :nb
        WHERE id = :menu_id
    ");
    $stmtStock->execute([
        'nb'      => (int) $commande['nb_personnes'],
        'menu_id'=> (int) $commande['menu_id']
    ]);

    $pdo->commit();

    $_SESSION['success'] = "Commande annulée avec succès.";

} catch (Exception $e) {

    $pdo->rollBack();
    $_SESSION['error'] = "Erreur lors de l'annulation de la commande.";
}

/* ========== Redirection finale ========== */

header('Location: commande-utilisateur.php');
exit;


/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';
require_once __DIR__ . '/../services/commandeService.php';
require_once __DIR__ . '/../config/commandeStatus.php';

/* ========== Récupération et validation de la commande ========== */

$commandeId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$userId     = (int) $_SESSION['user']['id'];

$commande = getCommandeById($pdo, $commandeId);

/* ========== Sécurité : propriété de la commande ========== */

if (!$commande || (int) $commande['utilisateur_id'] !== $userId) {
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Sécurité : statut modifiable ========== */

if ($commande['statut'] !== STATUT_EN_ATTENTE) {
    $_SESSION['error'] = "Vous ne pouvez modifier une commande que si elle est en attente.";
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Traitement du formulaire ========== */

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $error = modifierCommandeUtilisateur($pdo, $commande, $_POST);

    if (!$error) {
        $_SESSION['success'] = "Commande modifiée avec succès.";
        header('Location: commande-utilisateur.php');
        exit;
    }
}

/* ========== Préparation des données du formulaire ========== */

$date = new DateTime($commande['date_prestation']);

$dateValue  = $date->format('Y-m-d');
$heureValue = $date->format('H:i');

/* ========== Détermination du mode de réception ========== */

$isLivraison = ($commande['adresse'] !== 'Retrait sur place');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Modifier commande";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<!-- ===== Titre ===== -->
<section class="hero-section commandes-hero">
    <h1>Modifier ma commande</h1>
    <p>Vous pouvez modifier cette commande tant qu'elle est en attente.</p>
</section>

<section class="profil-container">
    <form class="profil-form form-card" method="POST">

        <!-- Message d’erreur -->
        <?php if ($error): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <!-- Menu (non modifiable) -->
        <p><strong>Menu :</strong> <?= htmlspecialchars($commande['menu_nom']) ?></p>

        <!-- Date -->
        <label>Date *</label>
        <input
            type="date"
            name="date"
            value="<?= htmlspecialchars($dateValue) ?>"
            required
        >

        <!-- Heure -->
        <label>Heure *</label>
        <input
            type="time"
            name="heure"
            value="<?= htmlspecialchars($heureValue) ?>"
            required
        >

        <!-- Nombre de personnes -->
        <label>Nombre de personnes *</label>
        <input
            type="number"
            name="nb_personnes"
            min="<?= (int) $commande['nb_personnes_min'] ?>"
            value="<?= (int) $commande['nb_personnes'] ?>"
            required
        >

        <!-- Mode de réception -->
        <h2>Mode de réception *</h2>

        <label>
            <input
                type="radio"
                name="reception"
                value="retrait"
                <?= $isLivraison ? '' : 'checked' ?>
            >
            Retrait sur place
        </label>

        <label>
            <input
                type="radio"
                name="reception"
                value="livraison"
                <?= $isLivraison ? 'checked' : '' ?>
            >
            Livraison
        </label>

        <!-- Adresse de livraison -->
        <div class="livraison-adresse <?= $isLivraison ? '' : 'is-hidden' ?>">

            <label>Adresse</label>
            <input
                type="text"
                name="adresse"
                value="<?= $isLivraison ? htmlspecialchars($commande['adresse']) : '' ?>"
            >

            <label>Code postal</label>
            <input
                type="text"
                name="code_postal"
                value=""
            >

            <label>Ville</label>
            <input
                type="text"
                name="ville"
                value="<?= $isLivraison ? htmlspecialchars($commande['ville']) : '' ?>"
            >
        </div>

        <!-- Bouton validation -->
        <button class="btn-commande" type="submit">
            Enregistrer
        </button>

        <!-- Lien retour -->
        <div class="auth-links">
            <a href="commande-utilisateur.php">Retour à mes commandes</a>
        </div>

    </form>
</section>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
