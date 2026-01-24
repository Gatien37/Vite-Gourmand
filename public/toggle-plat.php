<?php
/* ========== Sécurité : accès employé ou administrateur ========== */
require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Sécurité : méthode HTTP ========== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: gestion-plats.php');
    exit;
}

/* ========== Sécurité CSRF ========== */
if (
    empty($_POST['csrf_token']) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    http_response_code(403);
    exit('Action non autorisée (CSRF).');
}

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/platModel.php';

/* ========== Validation des paramètres ========== */
$id     = (int) ($_POST['id'] ?? 0);
$action = $_POST['action'] ?? '';

if (
    !$id ||
    !in_array($action, ['desactiver', 'activer'], true)
) {
    header('Location: gestion-plats.php');
    exit;
}

/* ========== Détermination du statut ========== */
$actif = ($action === 'activer');

/* ========== Mise à jour du plat ========== */
togglePlat($pdo, $id, $actif);

/* ========== Redirection ========== */
header('Location: gestion-plats.php');
exit;
