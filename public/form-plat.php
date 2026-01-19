<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/platModel.php';
require_once __DIR__ . '/../models/allergeneModel.php';
require_once __DIR__ . '/../services/platService.php';

/* ========= Initialisation ========= */
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$plat = null;
$error = null;

/* ========= Mode édition ========= */
if ($id) {
    $plat = getPlatById($pdo, $id);
    if (!$plat) {
        header('Location: gestion-plats.php');
        exit;
    }
}

/* ========= Données affichage ========= */
$allergenes = getAllAllergenes($pdo);

$allergenesSelectionnes = [];
if ($id) {
    $stmt = $pdo->prepare("
        SELECT allergene_id
        FROM plat_allergene
        WHERE plat_id = ?
    ");
    $stmt->execute([$id]);
    $allergenesSelectionnes = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

/* ========= Traitement formulaire ========= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = enregistrerPlat($pdo, $_POST, $id);

    if (!$error) {
        header('Location: gestion-plats.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php 
    $titre = "Modifier un plat";
    require_once __DIR__ . '/../partials/head.php'; ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1><?= $plat ? 'Modifier un plat' : 'Créer un plat' ?></h1>
</section>

<section class="form-container">
    <form method="POST" class="form-card">

        <?php if ($error): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>


        <label>Nom</label>
        <input type="text" name="nom"
               value="<?= htmlspecialchars($plat['nom'] ?? '') ?>" required>

        <label>Type</label>
        <select name="type">
            <option value="entree" <?= ($plat['type'] ?? '') === 'entree' ? 'selected' : '' ?>>Entrée</option>
            <option value="plat" <?= ($plat['type'] ?? '') === 'plat' ? 'selected' : '' ?>>Plat</option>
            <option value="dessert" <?= ($plat['type'] ?? '') === 'dessert' ? 'selected' : '' ?>>Dessert</option>
        </select>

        <label>Allergènes</label>
        <?php foreach ($allergenes as $allergene): ?>
            <label class="checkbox-allergene">
                <input type="checkbox"
                    name="allergenes[]"
                    value="<?= $allergene['id'] ?>"
                    <?= in_array($allergene['id'], $allergenesSelectionnes) ? 'checked' : '' ?>>
                <?= htmlspecialchars($allergene['nom']) ?>
            </label>
        <?php endforeach; ?>


        <button class="btn-commande">Enregistrer</button>

        <div class="auth-links">
            <a href="gestion-plats.php">← Retour</a>
        </div>
    </form>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
