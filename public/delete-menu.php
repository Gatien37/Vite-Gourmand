<?php
/* ========== Sécurité : accès employé ou administrateur ========== */

require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';

/* ========== Sécurité : paramètre menu valide ========== */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: gestion-menus.php');
    exit;
}

/* ========== Suppression du menu ========== */

$menuId = (int) $_GET['id'];

deleteMenu($pdo, $menuId);

/* ========== Redirection vers la gestion des menus ========== */

header('Location: gestion-menus.php');
exit;
