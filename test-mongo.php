<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Début<br>";

require_once __DIR__ . '/config/mongo.php';

echo "Connexion Mongo OK<br>";

$stats = $menuStatsCollection->find();

foreach ($stats as $stat) {
    echo '<pre>';
    var_dump($stat);
    echo '</pre>';
}

echo "Fin";
