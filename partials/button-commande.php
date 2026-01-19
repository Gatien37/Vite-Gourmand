<?php
$isLogged = isset($_SESSION['user']);
$hasStock = $menu['stock'] > 0;

if ($hasStock) {

    if ($isLogged) {
        $commandeUrl = "commande.php?menu_id=" . (int)$menuId;
    } else {
        $commandeUrl = "connexion.php?redirect=commande&menu_id=" . (int)$menuId;
    }
    ?>

    <a href="<?= htmlspecialchars($commandeUrl) ?>" class="btn-commande">
        Commander
    </a>

<?php } else { ?>

    <button class="btn-commande btn-disabled" disabled>
        Bientôt disponible
    </button>

<?php } ?>
