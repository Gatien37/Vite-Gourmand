<?php
$isLogged = isset($_SESSION['user']);
$hasStock = $menu['stock'] > 0;

if ($hasStock) {

    if ($isLogged) {
        $commandeUrl = "commande.php?menu_id=" . $menuId;
    } else {
        $commandeUrl = "connexion.php?redirect=commande&menu_id=" . $menuId;
    }

}
?>
