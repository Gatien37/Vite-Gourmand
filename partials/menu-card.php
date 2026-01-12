<div class="menu-item">
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

            <h2><?= htmlspecialchars($menu['nom']) ?></h2>

            <p><b><?= htmlspecialchars($menu['description']) ?></b></p>

            <p>Minimum : <?= (int)$menu['nb_personnes_min'] ?> personnes</p>

            <p>Prix par personne: <?= number_format((float)$menu['prix_base'], 2) ?> €</p>

            <a href="detail-menu.php?id=<?= $menu['id'] ?>" class="btn-menu">
                Voir le détail
            </a>
        </div>