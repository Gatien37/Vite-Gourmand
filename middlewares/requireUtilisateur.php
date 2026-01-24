<?php
require_once __DIR__ . '/initSession.php';

if (
    empty($_SESSION['user']) ||
    empty($_SESSION['user']['id']) ||
    empty($_SESSION['user']['role'])
) {
    header('Location: /vite-gourmand/public/connexion.php');
    exit;
}
