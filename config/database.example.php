<?php

/**
 * Exemple de configuration de connexion à la base de données (LOCAL).
 *
 * ➜ Copier ce fichier en database.php
 * ➜ Adapter les valeurs selon votre environnement local
 *
 * En production (Heroku), la connexion est gérée via des variables
 * d’environnement (JAWSDB_URL).
 */

$host = 'localhost';
$dbname = 'vite_gourmand';
$user = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
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
