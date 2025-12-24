<?php
session_start();

// Vide toutes les variables de session
$_SESSION = [];

// Détruit la session
session_destroy();

// Optionnel : détruire le cookie de session (propre)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Redirection après déconnexion
header('Location: index.php');
exit;
