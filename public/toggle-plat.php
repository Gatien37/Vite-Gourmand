<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/platModel.php';

$id = (int) ($_GET['id'] ?? 0);
$action = $_GET['action'] ?? '';

if (!$id || !in_array($action, ['desactiver', 'activer'])) {
    header('Location: gestion-plats.php');
    exit;
}

$actif = ($action === 'activer');

togglePlat($pdo, $id, $actif);

header('Location: gestion-plats.php');
exit;
