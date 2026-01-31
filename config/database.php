<?php

/**
 * Connexion MySQL
 * - Local : XAMPP / WAMP
 * - Production (Heroku) : via JAWSDB_URL
 */

if (getenv('JAWSDB_URL')) {
    // --- Production (Heroku - JawsDB) ---
    $url = parse_url(getenv('JAWSDB_URL'));

    $host     = $url['host'];
    $dbname   = ltrim($url['path'], '/');
    $user     = $url['user'];
    $password = $url['pass'];
} else {
    // --- Local ---
    $host     = 'localhost';
    $dbname   = 'vite_gourmand';
    $user     = 'root';
    $password = '';
}

try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    // Message volontairement générique (sécurité)
    die('Erreur de connexion à la base de données.');
}
