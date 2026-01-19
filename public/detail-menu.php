<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: menus.php');
    exit;
}

$menuId = (int) $_GET['id'];
$menu = getMenuById($pdo, $menuId);

if (!$menu) {
    header('Location: menus.php');
    exit;
}

$plats = getPlatsByMenu($pdo, $menuId);
$allergenes = getAllergenesByMenu($pdo, $menuId);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Détail menu";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1><?= htmlspecialchars($menu['nom']) ?></h1>
    </section>

    <section class="detail-menu-content">

    <div class="menu-present">
        <div class="menu-image">
            <img src="assets/images/<?= htmlspecialchars($menu['image']) ?>"
            alt="<?= htmlspecialchars($menu['nom']) ?>">
        </div>

        <div class="menu-info">
            <p><b>Thème :</b> <?= htmlspecialchars($menu['theme']) ?></p>
            <p><b>Régime :</b> <?= htmlspecialchars($menu['regime']) ?></p>
            <p><b>Nombre de personnes minimum :</b> <?= (int)$menu['nb_personnes_min'] ?></p>
            <p><b>Prix :</b> <?= number_format((float)$menu['prix_base'], 2) ?> €/personne</p>
            <p><b>Stock disponible :</b> <?= (int)$menu['stock'] ?></p>


            <!-- Bouton Commander --> 
            <?php require __DIR__ . '/../partials/button-commande.php'; ?>

            <?php if ($menu['stock'] > 0): ?>
                <a href="<?= $commandeUrl ?>" class="btn-commande">Commander</a>

            <?php else: ?>
                <button class="btn-commande btn-disabled" disabled>Bientôt disponible</button>

            <?php endif; ?>

        </div>
    </div>

    <div class="plats-menu">
        <?php foreach ($plats as $plat): ?>
            <div class="plats-card">
                <h2><?= ucfirst($plat['type']) ?></h2>
                <img
                    src="assets/images/<?= htmlspecialchars($plat['image']) ?>"
                    alt="<?= htmlspecialchars($plat['nom']) ?>"
                >
                <p><b><?= htmlspecialchars($plat['nom']) ?></b></p>
            </div>
        <?php endforeach; ?>
    </div>


</section>

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

    <section class="conditions-wrapper">
        <section class="conditions">
            <h2>CONDITIONS DE COMMANDE</h2>
                <ul>
                    <li>Commande minimum selon le menu choisi.</li>
                    <li>Commande obligatoire 48h à l'avance afin de garantir la fraîcheur des produits.</li>
                    <li>Retrait ou livraison le jour même entre 9h et 18h.</li>
                    <li>Une facturation de 5 €, majorée de 0,59 € par kilomètre parcouru, s'applique pour toute livraison effectuée en dehors de la ville de Bordeaux.</li>
                    <li>Plats livrés froids, à réchauffer chez vous (instructions fournies).</li>
                    <li>Modifications possibles pour certaines allergies (nous contacter avant la commande).</li>
                    <li>Annulation sans frais jusqu'à 24h avant la livraison.</li>
                    <li>Paiement sécurisé en ligne ou à la livraison.</li>
                    <li>En cas de prêt de matériel, le client s'engage à le restituer après la prestation.
                    À compter de la notification envoyée lors du passage de la commande au statut « en attente du retour de matériel », le client dispose d'un délai de 10 jours ouvrés pour restituer le matériel.
                    Passé ce délai, des frais de 600 € pourront être appliqués conformément aux conditions générales de vente.
                    La restitution du matériel s'effectue sur prise de contact préalable avec la société.</li>
                </ul>

        </section>
    </section>

    <!-- Bouton Commander --> 
    <?php require __DIR__ . '/../partials/button-commande.php'; ?>

    <?php if ($menu['stock'] > 0): ?>
        <a href="<?= $commandeUrl ?>" class="btn-commande">Commander</a>

    <?php else: ?>
        <button class="btn-commande btn-disabled" disabled>Bientôt disponible</button>

    <?php endif; ?>


    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>