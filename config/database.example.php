<?php

/**
 * Exemple de configuration de connexion à la base de données.
 * 
 * ➜ Copier ce fichier en database.php
 * ➜ Adapter les valeurs selon votre environnement local
 */

$host = 'localhost';
$dbname = 'vite_gourmand';
$user = 'user';
$password = 'password';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données.');
}
