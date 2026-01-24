<?php
require_once __DIR__ . '/initSession.php';

if (
    empty($_SESSION['user']) ||
    $_SESSION['user']['role'] !== 'admin'
) {
    http_response_code(403);
    exit;
}
