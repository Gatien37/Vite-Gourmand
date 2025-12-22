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
        <h1>Menu Festif de Noël</h1>
    </section>

    <section class="detail-menu-content">

    <div class="menu-present">
        <div class="menu-image">
            <img src="assets/images/menu-noel.jpg" alt="Menu de noel">
        </div>

        <div class="menu-info">
            <p><b>Thème :</b> Noël</p>
            <p><b>Régime :</b> Classique</p>
            <p><b>Nombre de personnes minimum :</b> 6</p>
            <p><b>Prix :</b> 24.90€/personne</p>
            <p><b>Stock disponible :</b> 20</p>
            <button class="btn-commande">Commander</button>
        </div>
    </div>

    <div class="plats-menu">
        <div class="plats-card">
            <h2>Entrée</h2>
            <img src="assets/images/entree-noel.jpg" alt="Entrée du menu de noel">
            <p><b>Terrine de saumon fumé & aneth</b></p>
        </div>

        <div class="plats-card">
            <h2>Plat</h2>
            <img src="assets/images/plat-noel.jpg" alt="Plat du menu de noel">
            <p><b>Suprême de dinde farci aux marrons</b></p>
        </div>

        <div class="plats-card">
            <h2>Dessert</h2>
            <img src="assets/images/dessert-noel.jpg" alt="Dessert du menu de noel">
            <p><b>Bûche chocolat-praliné artisanale</b></p>
        </div>
    </div>

</section>

    <section class="menu-description-wrapper">
        <section class="description-menu">
            <h2>PRÉSENTATION DU MENU</h2>
            <p>Ce menu festif réunit des saveurs chaleureuses et raffinées pour célébrer Noël dans les meilleures conditions. Préparé avec des produits frais et sélectionnés,
            il offre un équilibre parfait entre tradition et gourmandise, idéal pour un repas convivial en famille ou entre collègues.</p>
            <h2>DESCRIPTION COMPLÈTE</h2>
            <p>Le Menu Festif de Noël a été imaginé pour sublimer votre repas du réveillon. Il débute par une terrine de saumon fumé et d'aneth, délicatement parfumée, servie avec un léger condiment citronné.
                En plat principal, vous dégusterez un suprême de dinde farci aux marrons, accompagné d'une sauce crémeuse et d'un assortiment de légumes de saison rôtis au four. Pour terminer sur une note sucrée,
                Julie et José proposent une bûche chocolat-praliné artisanale, réalisée à partir de chocolat noir de qualité et d'un praliné croustillant.
                Ce menu a été pensé pour être généreux, festif et facile à partager. Chaque préparation est réalisée le jour même afin de garantir une fraîcheur optimale et une expérience gustative authentique.</p>
            <h2>LISTE DES ALLERGÈNES</h2>
            <p><b>Ce menu peut contenir :</b></p>
            <ul>
                <li>Poisson (terrine de saumon)</li>
                <li>Gluten (bûche pâtissière, farce de la dinde)</li>
                <li>Lait (crème, chocolat, beurre)</li>
                <li>Fruits à coque (marrons, praliné)</li>
                <li>Œufs (dessert)</li>
                <li>Soja (traces possibles dans certains ingrédients)</li>
            </ul>
        </section>
    </section>

    <section class="conditions-wrapper">
        <section class="conditions">
            <h2>CONDITIONS DU MENU FESTIF DE NOËL</h2>
            <ul>
                <li>Commande minimum : 6 personnes.</li>
                <li>Commande obligatoire 48h à l'avance pour garantir la fraîcheur des produits.</li>
                <li>Retrait ou livraison le jour même entre 9h et 18h.</li>
                <li>Une facturation de 5 €, majorée de 0,59 € par kilomètre parcouru, s'applique pour toute livraison effectuée en dehors de la ville de Bordeaux.</li>
                <li>Plats livrés froids, à réchauffer chez vous (instructions fournies)</li>
                <li>Modifications possibles pour certaines allergies (nous contacter avant la commande)</li>
                <li>Annulation sans frais jusqu'à 24h avant la livraison</li>
                <li>Paiement sécurisé en ligne ou à la livraison</li>
            </ul>
        </section>
    </section>

    <button class="btn-commande">Commander</button>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>