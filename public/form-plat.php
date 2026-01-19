<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/platModel.php';
require_once __DIR__ . '/../models/allergeneModel.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$plat = null;
$error = null;

if ($id) {
    $plat = getPlatById($pdo, $id);
    if (!$plat) {
        header('Location: gestion-plats.php');
        exit;
    }
}

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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom  = trim($_POST['nom'] ?? '');
    $type = $_POST['type'] ?? '';
    $allergenesIds = array_map('intval', $_POST['allergenes'] ?? []);

    if (!$nom || !$type) {
        $error = "Tous les champs sont obligatoires.";
    } elseif (!in_array($type, ['entree', 'plat', 'dessert'])) {
        $error = "Type de plat invalide.";
    } else {

        savePlat($pdo, [
            'nom' => $nom,
            'type' => $type
        ], $id);

        $platId = $id ? $id : $pdo->lastInsertId();

        $stmt = $pdo->prepare("DELETE FROM plat_allergene WHERE plat_id = ?");
        $stmt->execute([$platId]);

        if (!empty($allergenesIds)) {
            $stmt = $pdo->prepare("
                INSERT INTO plat_allergene (plat_id, allergene_id)
                VALUES (?, ?)
            ");

            foreach ($allergenesIds as $allergeneId) {
                $stmt->execute([$platId, $allergeneId]);
            }
        }

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
