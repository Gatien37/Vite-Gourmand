<?php

use MongoDB\Client;

/**
 * Retourne les collections MongoDB utilisées par l'application.
 * Mongo est chargé UNIQUEMENT quand cette fonction est appelée.
 */
function getMongoCollections(): array
{
    $mongoUri = getenv('MONGODB_URI');

    if (!$mongoUri) {
        throw new RuntimeException('MONGODB_URI non définie');
    }

    $client = new Client($mongoUri);

    $db = $client->vite_gourmand;

    return [
        'db' => $db,
        'menuStatsCollection' => $db->menu_stats
    ];
}
