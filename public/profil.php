<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/utilisateurModel.php';

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

$userId = $_SESSION['user']['id'];

$user = getUtilisateurById($pdo, $userId);

if (!$user) {
    header('Location: espace-utilisateur.php');
    exit;
}

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        empty($_POST['adresse']) ||
        empty($_POST['ville']) ||
        empty($_POST['code_postal'])
    ) {
        $error = "Tous les champs d'adresse sont obligatoires.";
    } else {
        updateAdresseUtilisateur($pdo, $userId, $_POST);
        $success = "Adresse mise à jour avec succès.";
        $user = getUtilisateurById($pdo, $userId); // rechargement
    }
}


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
        <h1>Mon profil</h1>
        <p>Modifiez vos informations personnelles.</p>
    </section>

    <section class="profil-container">

        <form class="profil-form form-card" action="#" method="POST">

            <?php if ($success): ?>
                <p class="alert-success"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>

            <?php if ($error): ?>
                <p class="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" disabled>
            <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" disabled>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
            <input type="text" name="telephone" value="<?= htmlspecialchars($user['gsm']) ?>" disabled>

            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" value="<?= htmlspecialchars($user['adresse']) ?>">

            <label for="ville">Ville</label>
            <input type="text" name="ville" value="<?= htmlspecialchars($user['ville']) ?>">

            <label for="code-postal">Code postal</label>
            <input type="text" name="code_postal" value="<?= htmlspecialchars($user['code_postal']) ?>">

            <button type="submit" class="btn-commande">Enregistrer les modifications</button>
            <div class="auth-links">
                <a href="espace-utilisateur.php">Retour à mon tableau de bord</a>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
