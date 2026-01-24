<?php
/* ========== Initialisation sécurisée de la session ========== */
require_once __DIR__ . '/../middlewares/initSession.php';

/* ========== Destruction des données de session ========== */
$_SESSION = [];

/* ========== Destruction de la session serveur ========== */
session_destroy();

/* ========== Suppression propre du cookie de session ========== */
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

/* ========== Redirection après déconnexion ========== */
header('Location: index.php');
exit;
