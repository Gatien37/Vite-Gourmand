<?php
/* ========== Sécurité : accès employé ou administrateur ========== */
require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Vérification méthode HTTP ========== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: gestion-menus.php');
    exit;
}

/* ========== Vérification CSRF ========== */
if (
    empty($_POST['csrf_token']) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    http_response_code(403);
    exit('Action non autorisée.');
}

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/menuModel.php';

/* ========== Validation de l’ID menu ========== */
$menuId = (int) ($_POST['menu_id'] ?? 0);

if ($menuId <= 0) {
    header('Location: gestion-menus.php');
    exit;
}

/* ========== Suppression du menu ========== */
deleteMenu($pdo, $menuId);

/* ========== Redirection finale ========== */
header('Location: gestion-menus.php');
exit;
