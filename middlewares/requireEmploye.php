<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

if (!in_array($_SESSION['user']['role'], ['employe', 'admin'])) {
    http_response_code(403);
    exit('Accès interdit');
}
