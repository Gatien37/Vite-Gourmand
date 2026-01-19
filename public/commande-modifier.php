<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';
require_once __DIR__ . '/../services/commandeService.php';
require_once __DIR__ . '/../config/commandeStatus.php';

/* ========= Sécurité utilisateur ========= */
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

/* ========= Récupération commande ========= */
$commandeId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$userId = (int) $_SESSION['user']['id'];

$commande = getCommandeById($pdo, $commandeId);

if (!$commande || (int) $commande['utilisateur_id'] !== $userId) {
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========= Statut modifiable ========= */
if ($commande['statut'] !== STATUT_EN_ATTENTE) {
    $_SESSION['error'] = "Vous ne pouvez modifier une commande que si elle est en attente.";
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========= Traitement formulaire ========= */
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = modifierCommandeUtilisateur($pdo, $commande, $_POST);

    if (!$error) {
        $_SESSION['success'] = "Commande modifiée avec succès.";
        header('Location: commande-utilisateur.php');
        exit;
    }
}

/* ========= Pré-remplissage formulaire ========= */
$dt = new DateTime($commande['date_prestation']);
$dateValue = $dt->format('Y-m-d');
$heureValue = $dt->format('H:i');

$isLivraison = ($commande['adresse'] !== 'Retrait sur place');
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Modifier commande";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Modifier ma commande</h1>
    <p>Vous pouvez modifier cette commande tant qu'elle est en attente.</p>
</section>

<section class="profil-container">
    <form class="profil-form form-card" method="POST">

        <?php if ($error): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <p><strong>Menu :</strong> <?= htmlspecialchars($commande['menu_nom']) ?></p>

        <label>Date *</label>
        <input type="date" name="date" value="<?= htmlspecialchars($dateValue) ?>" required>

        <label>Heure *</label>
        <input type="time" name="heure" value="<?= htmlspecialchars($heureValue) ?>" required>

        <label>Nombre de personnes *</label>
        <input type="number" name="nb_personnes" min="<?= (int)$commande['nb_personnes_min'] ?>"
               value="<?= (int)$commande['nb_personnes'] ?>" required>

        <h2>Mode de réception *</h2>
        <label>
            <input type="radio" name="reception" value="retrait" <?= $isLivraison ? '' : 'checked' ?>>
            Retrait sur place
        </label>
        <label>
            <input type="radio" name="reception" value="livraison" <?= $isLivraison ? 'checked' : '' ?>>
            Livraison
        </label>

        <div class="livraison-adresse <?= $isLivraison ? '' : 'is-hidden' ?>">
            <label>Adresse</label>
            <input type="text" name="adresse" value="<?= $isLivraison ? htmlspecialchars($commande['adresse']) : '' ?>">

            <label>Code postal</label>
            <input type="text" name="code_postal" value="">

            <label>Ville</label>
            <input type="text" name="ville" value="<?= $isLivraison ? htmlspecialchars($commande['ville']) : '' ?>">
        </div>

        <button class="btn-commande" type="submit">Enregistrer</button>

        <div class="auth-links">
            <a href="commande-utilisateur.php">Retour à mes commandes</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
