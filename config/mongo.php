<?php

/* ========== Chargement de l’autoloader Composer ========== */

require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

/* ========== Connexion à MongoDB ========== */

$mongoClient = new Client("mongodb://localhost:27017");

// Sélection de la base de données
$mongoDb = $mongoClient->vite_gourmand;

// Sélection de la collection des statistiques menus
$menuStatsCollection = $mongoDb->menu_stats;
