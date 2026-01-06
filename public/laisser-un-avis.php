<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';
require_once __DIR__ . '/../models/avisModel.php';

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}


if (!isset($_GET['commande_id']) || !is_numeric($_GET['commande_id'])) {
    header('Location: commande-utilisateur.php');
    exit;
}

$userId = (int)$_SESSION['user']['id'];
$commandeId = (int) $_GET['commande_id'];
$commande = getCommandeById($pdo, $commandeId);


if (
    !$commande ||
    (int)$commande['utilisateur_id'] !== $userId ||
    $commande['statut'] !== 'terminee'
) {
    header('Location: commande-utilisateur.php');
    exit;
}


if (avisExistePourCommande($pdo, $commandeId)) {
    $_SESSION['error'] = "Vous avez déjà laissé un avis pour cette commande.";
    header('Location: commande-utilisateur.php');
    exit;
}

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $note = (int)($_POST['note'] ?? 0);
    $commentaire = trim($_POST['commentaire'] ?? '');

    if ($note < 1 || $note > 5) {
        $error = "Veuillez sélectionner une note.";
    }

    if (!$error) {
        insertAvis($pdo, $commandeId, $note, $commentaire);

        $_SESSION['success'] = "Merci pour votre avis. Il sera publié après validation.";
        header('Location: commande-utilisateur.php');
        exit;
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
        <h1>Laisser un avis</h1>
        <p>Partagez votre expérience avec Vite & Gourmand.</p>
    </section>

    <section class="avis-page-container">
        <form class="avis-form form-card" action="#" method="POST">
            <h2>Votre commande</h2>
            <p>
                <strong>Menu :</strong>
                <?= htmlspecialchars($commande['menu_nom']) ?>
            </p>

            <p>
                <strong>Commande :</strong>
                #CMD-<?= (int)$commande['id'] ?>
            </p>
            <h2>Votre note</h2>
            <div class="rating" id="rating">
                <input type="hidden" name="note" id="note" value="0">

                <span class="star" data-value="1">★</span>
                <span class="star" data-value="2">★</span>
                <span class="star" data-value="3">★</span>
                <span class="star" data-value="4">★</span>
                <span class="star" data-value="5">★</span>
            </div>

            <h2>Votre commentaire</h2>
            <textarea name="commentaire" rows="5" placeholder="Donnez votre avis sur le menu, la livraison, la qualité des plats…"></textarea>
            <button type="submit" class="btn-commande">Envoyer mon avis</button>
            <div class="auth-links">
                <a href="commande-utilisateur.php">← Retour à mes commandes</a>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
