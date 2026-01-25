<?php

/*A enlever en production */
$isHttps = (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443
);
/*FIN A enlever en production */


session_set_cookie_params([
    'httponly' => true,
    'secure'   => $isHttps,
    'samesite' => 'Strict'
]);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
