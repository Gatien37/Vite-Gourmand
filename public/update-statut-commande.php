<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/commandeController.php';

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

handleUpdateStatutCommande($pdo);
