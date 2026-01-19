<div class="menu-item">

    <!-- Affichage de l’image du menu (image réelle ou image par défaut) -->
    <?php if (!empty($menu['image'])): ?>
        <img 
            src="assets/images/<?= htmlspecialchars($menu['image']) ?>"
            alt="Menu <?= htmlspecialchars($menu['nom']) ?>"
            loading="lazy"
        >
    <?php else: ?>
        <img 
            src="assets/images/placeholder-menu.jpg"
            alt="Image non disponible"
            loading="lazy"
        >
    <?php endif; ?>

    <!-- Nom du menu -->
    <h2><?= htmlspecialchars($menu['nom']) ?></h2>

    <!-- Description courte -->
    <p><strong><?= htmlspecialchars($menu['description']) ?></strong></p>

    <!-- Nombre minimum de personnes -->
    <p>Minimum : <?= (int) $menu['nb_personnes_min'] ?> personnes</p>

    <!-- Prix par personne -->
    <p>Prix par personne : <?= number_format((float) $menu['prix_base'], 2) ?> €</p>

    <!-- Lien vers la page détail du menu -->
    <a href="detail-menu.php?id=<?= (int) $menu['id'] ?>" class="btn-menu">
        Voir le détail
    </a>

</div>
