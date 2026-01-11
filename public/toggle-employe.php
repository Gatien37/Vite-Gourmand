<?php
require_once __DIR__ . '/../middlewares/requireAdmin.php';
require_once __DIR__ . '/../config/database.php';

$id = (int)($_GET['id'] ?? 0);
$action = $_GET['action'] ?? '';

if (!$id || !in_array($action, ['enable', 'disable'])) {
    header('Location: gestion-employes.php');
    exit;
}

$actif = ($action === 'enable') ? 1 : 0;

$stmt = $pdo->prepare("
    UPDATE utilisateur
    SET actif = :actif
    WHERE id = :id AND role = 'employe'
");
$stmt->execute([
    'actif' => $actif,
    'id' => $id
]);

header('Location: gestion-employes.php');
exit;
