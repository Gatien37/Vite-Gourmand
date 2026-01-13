<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';
require_once __DIR__ . '/../services/commandeService.php';
require_once __DIR__ . '/../services/mailService.php';

/* ================== SÉCURITÉ ================== */

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

if (!isset($_GET['menu_id']) || !is_numeric($_GET['menu_id'])) {
    header('Location: menus.php');
    exit;
}

$menuId = (int) $_GET['menu_id'];
$menu = getMenuById($pdo, $menuId);

if (!$menu) {
    header('Location: menus.php');
    exit;
}

$error = null;

/* ================== TRAITEMENT FORMULAIRE ================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $resultat = traiterCommande(
        $pdo,
        $menu,
        $_POST,
        $_SESSION['user']
    );

    if ($resultat['error']) {
        $error = $resultat['error'];
    } else {
        envoyerMailConfirmation(
            $_SESSION['user']['email'],
            $resultat['recap']
        );

        header('Location: confirmation.php?id=' . $resultat['commande_id']);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Commande";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Passer commande</h1>
    <p>Complétez les informations ci-dessous pour finaliser votre commande.</p>
</section>

<section class="commande-container">

    <!-- ===== RÉCAP MENU ===== -->
    <div class="recap-menu">
        <h2>Votre menu</h2>

        <img src="assets/images/<?= htmlspecialchars($menu['image']) ?>"
             alt="<?= htmlspecialchars($menu['nom']) ?>">

        <h3><?= htmlspecialchars($menu['nom']) ?></h3>

        <p>Prix : <?= number_format((float)$menu['prix_base'], 2) ?> € / personne</p>
        <p>Minimum : <?= (int)$menu['nb_personnes_min'] ?> personnes</p>
        <p>Stock disponible pour <?= (int)$menu['stock'] ?> personnes</p>
    </div>

    <!-- ===== FORMULAIRE ===== -->
    <form
        id="commande-form"
        class="commande-form form-card"
        method="POST"
        action="commande.php?menu_id=<?= $menuId ?>"
        data-prix-base="<?= (float)$menu['prix_base'] ?>"
        data-min-personnes="<?= (int)$menu['nb_personnes_min'] ?>"
    >

        <?php if ($error): ?>
            <p id="commande-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <h2>Informations de commande</h2>

        <label for="nb_personnes">Nombre de personnes *</label>
        <input type="number" id="nb_personnes" name="nb_personnes" min="<?= (int)$menu['nb_personnes_min'] ?>" data-min="<?= (int)$menu['nb_personnes_min'] ?>" required>

        <label for="date">Date *</label>
        <input type="date" id="date" name="date" required>

        <label for="heure">Heure *</label>
        <input type="time" id="heure" name="heure" required>

        <h2>Mode de réception *</h2>
        
        <label class="radio-option">
            <input type="radio" name="reception" value="retrait">
            <span>Retrait sur place (gratuit)</span>
        </label>

        <label class="radio-option">
            <input type="radio" name="reception" value="livraison">
            <span>Livraison (5 € + 0.59€/km en dehors de Bordeaux)</span>
        </label>

        <div class="livraison-adresse is-hidden">
            <label for="adresse">Adresse *</label>
            <input type="text" id="adresse" name="adresse">

            <label for="code_postal">Code postal *</label>
            <input type="text" id="code_postal" name="code_postal" required>

            <label for="ville">Ville *</label>
            <input type="text" id="ville" name="ville">

        </div>

          <!-- ===== RÉCAP PRIX ===== -->
        <div class="price-summary">
            <h3>Détail du prix</h3>

            <p>Menu : <span id="prix-menu">0 €</span></p>
            <p id="reduction-line" class="is-hidden">
                <span>Réduction : </span><span id="reduction">-0 €</span>
            </p>
            <p>Livraison : <span id="prix-livraison">0 €</span></p>

            <p class="price-total">
                <strong>Total : <span id="prix-total">0 €</span></strong>
            </p>
        </div>
        

        <button type="submit" class="btn-commande">Valider la commande</button>
    </form>

</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
