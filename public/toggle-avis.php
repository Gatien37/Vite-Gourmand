<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/avisModel.php';

$id = (int) ($_GET['id'] ?? 0);
$action = $_GET['action'] ?? '';

if (!$id || !in_array($action, ['valider', 'refuser'])) {
    header('Location: gestion-avis.php');
    exit;
}

$valide = ($action === 'valider');

setAvisValide($pdo, $id, $valide);

header('Location: gestion-avis.php');
exit;
