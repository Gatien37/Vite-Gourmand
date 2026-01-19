<?php
/* ========== Initialisation de la session ========== */

session_start();

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';
require_once __DIR__ . '/../services/commandeService.php';
require_once __DIR__ . '/../services/mailService.php';

/* ========== Sécurité : utilisateur connecté ========== */

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

/* ========== Sécurité : menu valide ========== */

if (!isset($_GET['menu_id']) || !is_numeric($_GET['menu_id'])) {
    header('Location: menus.php');
    exit;
}

$menuId = (int) $_GET['menu_id'];
$menu   = getMenuById($pdo, $menuId);

if (!$menu) {
    header('Location: menus.php');
    exit;
}

/* ========== Initialisation des erreurs ========== */

$error = null;

/* ========== Traitement du formulaire ========== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* Acceptation des CGV obligatoire */
    if (empty($_POST['accept_cgv'])) {
        $error = "Vous devez accepter les Conditions Générales de Vente pour valider la commande.";
    } else {

        /* Traitement métier de la commande */
        $resultat = traiterCommande(
            $pdo,
            $menu,
            $_POST,
            $_SESSION['user']
        );

        /* Gestion des erreurs */
        if (!empty($resultat['error'])) {
            $error = $resultat['error'];
        } else {

            /* Envoi de l’email de confirmation */
            envoyerMailConfirmation(
                $_SESSION['user']['email'],
                $resultat['recap']
            );

            /* Redirection vers la confirmation */
            header('Location: confirmation.php?id=' . $resultat['commande_id']);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Commande";
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
    <h1>Passer commande</h1>
    <p>Complétez les informations ci-dessous pour finaliser votre commande.</p>
</section>

<section class="commande-container">

    <!-- ===== Récapitulatif du menu ===== -->
    <div class="recap-menu">
        <h2>Votre menu</h2>

        <img
            src="assets/images/<?= htmlspecialchars($menu['image']) ?>"
            alt="<?= htmlspecialchars($menu['nom']) ?>"
        >

        <h3><?= htmlspecialchars($menu['nom']) ?></h3>

        <p>Prix : <?= number_format((float) $menu['prix_base'], 2) ?> € / personne</p>
        <p>Minimum : <?= (int) $menu['nb_personnes_min'] ?> personnes</p>
        <p>Stock disponible pour <?= (int) $menu['stock'] ?> personnes</p>
    </div>

    <!-- ===== Formulaire de commande ===== -->
    <form
        id="commande-form"
        class="commande-form form-card"
        method="POST"
        action="commande.php?menu_id=<?= $menuId ?>"
        data-prix-base="<?= (float) $menu['prix_base'] ?>"
        data-min-personnes="<?= (int) $menu['nb_personnes_min'] ?>"
    >

        <!-- Message d’erreur -->
        <?php if ($error): ?>
            <p id="commande-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <h2>Informations de commande</h2>

        <!-- Nombre de personnes -->
        <label for="nb_personnes">Nombre de personnes *</label>
        <input
            type="number"
            id="nb_personnes"
            name="nb_personnes"
            min="<?= (int) $menu['nb_personnes_min'] ?>"
            data-min="<?= (int) $menu['nb_personnes_min'] ?>"
            required
        >

        <!-- Date -->
        <label for="date">Date *</label>
        <input
            type="date"
            id="date"
            name="date"
            min="<?= date('Y-m-d', strtotime('+2 days')) ?>"
            required
        >

        <!-- Heure -->
        <label for="heure">Heure *</label>
        <input
            type="time"
            id="heure"
            name="heure"
            required
        >

        <!-- Mode de réception -->
        <h2>Mode de réception *</h2>

        <label class="radio-option">
            <input type="radio" name="reception" value="retrait" required>
            <span>Retrait sur place (gratuit)</span>
        </label>

        <label class="radio-option">
            <input type="radio" name="reception" value="livraison">
            <span>Livraison (5 € + 0,59 €/km en dehors de Bordeaux)</span>
        </label>

        <!-- Adresse de livraison -->
        <div class="livraison-adresse is-hidden">
            <label for="adresse">Adresse *</label>
            <input type="text" id="adresse" name="adresse">

            <label for="code_postal">Code postal *</label>
            <input type="text" id="code_postal" name="code_postal">

            <label for="ville">Ville *</label>
            <input type="text" id="ville" name="ville">
        </div>

        <!-- ===== Récapitulatif du prix ===== -->
        <div class="price-summary">
            <h3>Détail du prix</h3>

            <p>Menu : <span id="prix-menu">0 €</span></p>

            <p id="reduction-line" class="is-hidden">
                <span>Réduction : </span>
                <span id="reduction">-0 €</span>
            </p>

            <p>Livraison : <span id="prix-livraison">0 €</span></p>

            <p class="price-total">
                <strong>Total : <span id="prix-total">0 €</span></strong>
            </p>
        </div>

        <!-- ===== Validation des CGV ===== -->
        <div class="cgv-validation">
            <label>
                <input type="checkbox" name="accept_cgv" required>
                J'ai lu et j'accepte les
                <a href="cgv.php" target="_blank" rel="noopener">
                    Conditions Générales de Vente
                </a>
            </label>
        </div>

        <!-- Bouton validation -->
        <button type="submit" class="btn-commande">
            Valider la commande
        </button>

        <p class="legal-hint">
            Les informations recueillies sont nécessaires au traitement de votre commande.
        </p>

    </form>

</section>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
