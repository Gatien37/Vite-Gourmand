<?php
require_once __DIR__ . '/../config/database.php';

$sql = "SELECT nom, prix_base FROM menu";
$stmt = $pdo->query($sql);
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <h1>Tous nos menus</h1>
            <p>Trouvez facilement le menu adapté à votre événement.</p>
    </section>

    <section class="filtres">
        <div class="filtre-icone filtre-invisible">
            <button class="filtre-btn">Prix maximum</button>
            <img src="assets/images/icone_fleche_bas.svg" alt="flèche bas">
        </div>
        <div class="filtre-icone filtre-invisible">
            <button class="filtre-btn">Fourchette de prix</button>
            <img src="assets/images/icone_fleche_bas.svg" alt="flèche bas">
        </div>
        <div class="filtre-icone filtre-visible">
            <button class="filtre-btn">Thème</button>
            <img src="assets/images/icone_fleche_bas.svg" alt="flèche bas">
        </div>
        <div class="filtre-responsive">
            <button class="filtre-btn">Filtres avancées</button>
            <img src="assets/images/icone_parametres.svg" alt="icone paramètres">
        </div>
        <div class="filtre-icone filtre-invisible">
            <button class="filtre-btn">Régime</button>
            <img src="assets/images/icone_fleche_bas.svg" alt="flèche bas">
        </div>
        <div class="filtre-icone filtre-invisible">
            <button class="filtre-btn">Nombre de personnes minimum</button>
            <img src="assets/images/icone_fleche_bas.svg" alt="flèche bas">
        </div>
            <button class="filtre-appliquer filtre-invisible">Appliquer</button>
        </div>
    </section>
    
    <!-- Test PDO Section -->
    <section>
        <h2>Menus (test PDO)</h2>

        <?php foreach ($menus as $menu): ?>
            <p>
                <?= htmlspecialchars($menu['nom']) ?> –
                <?= number_format($menu['prix_base']) ?> €
            </p>
        <?php endforeach; ?>
    </section>




    <section class="menus-list">
        <div class="menu-item">
            <img src="assets/images/menu-vegan.jpg" alt="Plat du menu vegan">
            <h2>Menu Vegan Savoureux</h2>
            <p>Un menu 100 % vegan, coloré et savoureux, préparé avec des ingrédients frais et de saison. </p>
            <p>Minimum : 4 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
        <div class="menu-item">
            <img src="assets/images/menu-noel.jpg" alt="Menu de noel">
            <h2>Menu Festif de Noel</h2>
            <p>Des plats chaleureux et raffinés pour un repas de Noël réussi.</p>
            <p>Minimum : 4 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
        <div class="menu-item">
            <img src="assets/images/menu-vegetarien.jpg" alt="Menu végétarien">
            <h2>Menu Gourmand Végétarien</h2>
            <p>Un menu coloré et savoureux, 100 % végétarien et riche en goût.</p>
            <p>Minimum : 4 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
        <div class="menu-item">
            <img src="assets/images/menu-anniversaire.jpg" alt="Menu anniversaire">
            <h2>Menu Anniversaire Enfant</h2>
            <p>Un menu joyeux, simple et savoureux, parfait pour les anniversaires d'enfants.</p>
            <p>Minimum : 8 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
        <div class="menu-item">
            <img src="assets/images/menu-cocktail.jpg" alt="Menu cocktail">
            <h2>Menu Cocktail Premium</h2>
            <p>Un menu raffiné pour vos apéritifs d'entreprise ou cocktails dinatoires.</p>
            <p>Minimum : 10 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
        <div class="menu-item">
            <img src="assets/images/menu-monde.jpg" alt="Menu monde">
            <h2>Menu Saveurs du Monde</h2>
            <p>Un voyage culinaire à travers plusieurs inspirations du monde.</p>
            <p>Minimum : 6 personnes</p>
            <button class="btn-commande">Voir le détail</button>
        </div>
    </section>
    
    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>