<?php

/* ========== Accès à la commande selon l’état utilisateur ========== */

$isLogged = isset($_SESSION['user']);
$hasStock = $menu['stock'] > 0;

if ($hasStock) {

    // Utilisateur connecté : accès direct à la commande
    if ($isLogged) {
        $commandeUrl = "commande.php?menu_id=" . (int) $menuId;
    }
    // Utilisateur non connecté : redirection vers la connexion
    else {
        $commandeUrl = "connexion.php?redirect=commande&menu_id=" . (int) $menuId;
    }
    ?>

    <a href="<?= htmlspecialchars($commandeUrl) ?>" class="btn-commande">
        Commander
    </a>

<?php } else { ?>

    <!-- Menu indisponible -->
    <button class="btn-commande btn-disabled" disabled>
        Bientôt disponible
    </button>

<?php } ?>
