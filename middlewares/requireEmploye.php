<?php
require_once __DIR__ . '/initSession.php';

if (
    empty($_SESSION['user']) ||
    !in_array($_SESSION['user']['role'], ['employe', 'admin'], true)
) {
    http_response_code(403);
    exit;
}
