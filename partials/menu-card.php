<div class="menu-item">
            <img 
                src="assets/images/<?= htmlspecialchars($menu['image']) ?>"
                alt="Menu <?= htmlspecialchars($menu['nom']) ?>"
            >

            <h2><?= htmlspecialchars($menu['nom']) ?></h2>

            <p><?= htmlspecialchars($menu['description']) ?></p>

            <p>Minimum : <?= (int)$menu['nb_personnes_min'] ?> personnes</p>

            <p>Prix par personne: <?= number_format((float)$menu['prix_base'], 2) ?> €</p>

            <a href="detail-menu.php?id=<?= $menu['id'] ?>" class="btn-menu">
                Voir le détail
            </a>
        </div>