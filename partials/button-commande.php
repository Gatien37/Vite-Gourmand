<?php

            $isLogged = isset($_SESSION['user']);

            if ($isLogged) {
                $commandeUrl = "commande.php?menu_id=" . $menuId;
            } else {
                $commandeUrl = "connexion.php?redirect=commande&menu_id=" . $menuId;
            }
            ?>