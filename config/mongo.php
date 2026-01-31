<?php

/* ========== Chargement de l’autoloader Composer ========== */
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

$mongoClient = null;
$mongoDb = null;
$menuStatsCollection = null;

$mongoUri = getenv('MONGO_URI') ?: getenv('MONGODB_URI');

try {
    if ($mongoUri) {
        $mongoClient = new Client(
            $mongoUri,
            [],
            ['typeMap' => ['root' => 'array', 'document' => 'array']]
        );
    } else {
        // Fallback local
        $mongoClient = new Client('mongodb://127.0.0.1:27017');
    }

    $mongoDb = $mongoClient->vite_gourmand;
    $menuStatsCollection = $mongoDb->menu_stats;

} catch (Throwable $e) {
    error_log('[MongoDB disabled] ' . $e->getMessage());
}
