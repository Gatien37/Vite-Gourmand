<?php
/* ========== Chargement des middlewares et dépendances ========== */

require_once __DIR__ . '/../middlewares/requireAdmin.php';
require_once __DIR__ . '/../config/database.php';

/* ========== Récupération et validation des paramètres ========== */

$id     = (int) ($_GET['id'] ?? 0);
$action = $_GET['action'] ?? '';

if (
    !$id ||
    !in_array($action, ['enable', 'disable'], true)
) {
    header('Location: gestion-employes.php');
    exit;
}

/* ========== Détermination du statut d’activation ========== */

$actif = ($action === 'enable') ? 1 : 0;

/* ========== Mise à jour du statut d’activation de l’employé ========== */

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

/* ========== Redirection vers la gestion des employés ========== */

header('Location: gestion-employes.php');
exit;
