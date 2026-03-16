<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/commandeController.php';
require_once __DIR__ . '/../services/commandeService.php';
require_once __DIR__ . '/../repositories/sql/commandeRepository.php';

$commandeRepository = new CommandeRepository($pdo);
$commandeService = new CommandeService($pdo, $commandeRepository);

$headers = getallheaders();

if (
    empty($headers['X-CSRF-Token']) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $headers['X-CSRF-Token'])
) {
    http_response_code(403);
    echo json_encode(['error' => 'Action non autorisée (CSRF).']);
    exit;
}

handleUpdateStatutCommande($pdo, $commandeService, $commandeRepository);
