<?php

/* ========== Chargement de l’autoloader Composer ========== */
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

/* ========== Connexion à MongoDB (local / prod) ========== */

$mongoUri = getenv('MONGODB_URI');

if ($mongoUri === false) {
    // --- Local (fallback) ---
    $mongoUri = 'mongodb://localhost:27017';
}

$mongoClient = new Client($mongoUri);

/* ========== Sélection base et collections ========== */

$mongoDb = $mongoClient->vite_gourmand;
$menuStatsCollection = $mongoDb->menu_stats;
