<?php
/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';

/* ========== Sécurité : paramètre menu valide ========== */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: menus.php');
    exit;
}

/* ========== Récupération du menu ========== */

$menuId = (int) $_GET['id'];
$menu   = getMenuById($pdo, $menuId);

/* ========== Sécurité : menu existant ========== */

if (!$menu) {
    header('Location: menus.php');
    exit;
}

/* ========== Récupération des données associées ========== */

$plats      = getPlatsByMenu($pdo, $menuId);
$allergenes = getAllergenesByMenu($pdo, $menuId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Détail menu";
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
        <h1><?= htmlspecialchars($menu['nom']) ?></h1>
    </section>

    <!-- ===== Présentation du menu ===== -->
    <section class="detail-menu-content">

        <div class="menu-present">

            <!-- Image du menu -->
            <div class="menu-image">
                <img
                    src="assets/images/<?= htmlspecialchars($menu['image']) ?>"
                    alt="<?= htmlspecialchars($menu['nom']) ?>"
                >
            </div>

            <!-- Informations principales -->
            <div class="menu-info">
                <p><strong>Thème :</strong> <?= htmlspecialchars($menu['theme']) ?></p>
                <p><strong>Régime :</strong> <?= htmlspecialchars($menu['regime']) ?></p>
                <p>
                    <strong>Nombre de personnes minimum :</strong>
                    <?= (int) $menu['nb_personnes_min'] ?>
                </p>
                <p>
                    <strong>Prix :</strong>
                    <?= number_format((float) $menu['prix_base'], 2) ?> €/personne
                </p>
                <p>
                    <strong>Stock disponible :</strong>
                    <?= (int) $menu['stock'] ?>
                </p>

                <!-- Bouton Commander -->
                <?php require __DIR__ . '/../partials/button-commande.php'; ?>
            </div>
        </div>

        <!-- ===== Liste des plats ===== -->
        <div class="plats-menu">
            <?php foreach ($plats as $plat): ?>
                <div class="plats-card">

                    <h2><?= ucfirst($plat['type']) ?></h2>

                    <img
                        src="assets/images/<?= htmlspecialchars($plat['image']) ?>"
                        alt="<?= htmlspecialchars($plat['nom']) ?>"
                    >

                    <p>
                        <strong><?= htmlspecialchars($plat['nom']) ?></strong>
                    </p>

                </div>
            <?php endforeach; ?>
        </div>

    </section>

    <!-- ===== Description du menu ===== -->
    <section class="menu-description-wrapper">
        <section class="description-menu">

            <h2>PRÉSENTATION DU MENU</h2>
            <p><?= nl2br(htmlspecialchars($menu['description'])) ?></p>

            <h2>DESCRIPTION COMPLÈTE</h2>
            <p><?= nl2br(htmlspecialchars($menu['description_longue'])) ?></p>

            <h2>LISTE DES ALLERGÈNES</h2>

            <?php if (!empty($allergenes)): ?>
                <ul>
                    <?php foreach ($allergenes as $allergene): ?>
                        <li><?= htmlspecialchars($allergene) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun allergène spécifique à signaler pour ce menu.</p>
            <?php endif; ?>

        </section>
    </section>

    <!-- ===== Conditions de commande ===== -->
    <section class="conditions-wrapper">
        <section class="conditions">

            <h2>CONDITIONS DE COMMANDE</h2>

            <ul>
                <li>Commande minimum selon le menu choisi.</li>
                <li>Commande obligatoire 48h à l'avance afin de garantir la fraîcheur des produits.</li>
                <li>Retrait ou livraison le jour même entre 9h et 18h.</li>
                <li>Livraison hors Bordeaux : 5 € + 0,59 € / km.</li>
                <li>Plats livrés froids, à réchauffer chez vous.</li>
                <li>Modifications possibles pour certaines allergies (nous contacter).</li>
                <li>Annulation sans frais jusqu'à 24h avant la livraison.</li>
                <li>Paiement sécurisé en ligne ou à la livraison.</li>
                <li>
                    En cas de prêt de matériel, restitution sous 10 jours ouvrés après notification,
                    sous peine de frais de 600 €.
                </li>
            </ul>

        </section>
    </section>

    <!-- ===== Bouton Commander (rappel bas de page) ===== -->
    <?php require __DIR__ . '/../partials/button-commande.php'; ?>
</main>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
