<?php

/* ========== Autoloader Composer ========== */
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

$mongoClient = null;
$mongoDb = null;
$menuStatsCollection = null;

/* ========== Récupération URI MongoDB ========== */
$mongoUri = getenv('MONGODB_URI');

try {
    if ($mongoUri) {
        // --- Production (MongoDB Atlas) ---
        $mongoClient = new Client(
            $mongoUri,
            [],
            ['typeMap' => ['root' => 'array', 'document' => 'array']]
        );
    } else {
        // --- Local (Docker MongoDB) ---
        $mongoClient = new Client('mongodb://127.0.0.1:27017');
    }

    $mongoDb = $mongoClient->vite_gourmand;
    $menuStatsCollection = $mongoDb->menu_stats;

} catch (Throwable $e) {
    // Mongo indisponible → site continue de fonctionner
    error_log('[MongoDB disabled] ' . $e->getMessage());
}
