<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: gestion-menus.php');
    exit;
}

$menuId = (int) $_GET['id'];

deleteMenu($pdo, $menuId);

header('Location: gestion-menus.php');
exit;
