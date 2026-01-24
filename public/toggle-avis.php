<?php
/* ========== Initialisation de la session ========== */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ========== Sécurisation : accès employé / admin ========== */
require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/avisModel.php';

/* ========== Sécurisation de la méthode HTTP ========== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: gestion-avis.php');
    exit;
}

/* ========== Vérification CSRF ========== */
if (
    empty($_POST['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    http_response_code(403);
    exit('Action non autorisée (CSRF).');
}

/* ========== Récupération et validation des paramètres ========== */
$id     = (int) ($_POST['id'] ?? 0);
$action = $_POST['action'] ?? '';

if (
    !$id ||
    !in_array($action, ['valider', 'refuser'], true)
) {
    $_SESSION['error'] = "Action invalide.";
    header('Location: gestion-avis.php');
    exit;
}

/* ========== Détermination du statut ========== */
$valide = ($action === 'valider');

/* ========== Mise à jour de l’avis ========== */
setAvisValide($pdo, $id, $valide);

/* ========== Message de confirmation ========== */
$_SESSION['success'] = $valide
    ? "Avis validé avec succès."
    : "Avis refusé avec succès.";

/* ========== Redirection finale ========== */
header('Location: gestion-avis.php');
exit;
