<?php
/* ========== Sécurité : accès administrateur ========== */
require_once __DIR__ . '/../middlewares/requireAdmin.php';

/* ========== Sécurité CSRF ========== */
if (
    empty($_POST['csrf_token']) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    http_response_code(403);
    exit('Action non autorisée (CSRF).');
}

/* ========== Sécurité : méthode HTTP ========== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: gestion-employes.php');
    exit;
}

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';

/* ========== Validation des paramètres ========== */
$id     = (int) ($_POST['id'] ?? 0);
$action = $_POST['action'] ?? '';

if (
    !$id ||
    !in_array($action, ['enable', 'disable'], true)
) {
    header('Location: gestion-employes.php');
    exit;
}

/* ========== Détermination du statut ========== */
$actif = ($action === 'enable') ? 1 : 0;

/* ========== Mise à jour employé ========== */
$stmt = $pdo->prepare("
    UPDATE utilisateur
    SET actif = :actif
    WHERE id = :id
      AND role = 'employe'
");

$stmt->execute([
    'actif' => $actif,
    'id'    => $id
]);

/* ========== Redirection ========== */
header('Location: gestion-employes.php');
exit;
