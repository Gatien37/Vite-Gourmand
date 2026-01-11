<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

if ($_SESSION['user']['role'] !== 'admin') {
    http_response_code(403);
    exit('Accès réservé administrateur');
}
