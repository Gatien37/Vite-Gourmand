<?php
/* ========== Coordonnées du traiteur (point de départ) ========== */

define('TRAITEUR_LAT', 44.841225);
define('TRAITEUR_LON', -0.579018);

/* ========== Calcul de la distance entre deux points (Haversine) ========== */

function calculerDistanceKm(
    float $lat1,
    float $lon1,
    float $lat2,
    float $lon2
): float {
    $earthRadius = 6371;

    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);

    $latDelta = $lat2 - $lat1;
    $lonDelta = $lon2 - $lon1;

    $angle = 2 * asin(
        sqrt(
            pow(sin($latDelta / 2), 2) +
            cos($lat1) * cos($lat2) *
            pow(sin($lonDelta / 2), 2)
        )
    );

    return $angle * $earthRadius;
}

/* ========== Géocodage d’une adresse via l’API data.gouv.fr ========== */

function geocoderAdresse(string $adresse): ?array
{
    $url = 'https://api-adresse.data.gouv.fr/search/?q=' .
        urlencode($adresse) .
        '&limit=1';

    $response = @file_get_contents($url);

    if (!$response) {
        return null;
    }

    $data = json_decode($response, true);

    if (empty($data['features'])) {
        return null;
    }

    return [
        'lat' => $data['features'][0]['geometry']['coordinates'][1],
        'lon' => $data['features'][0]['geometry']['coordinates'][0]
    ];
}

/* ========== Calcul des frais de livraison ========== */

function calculerFraisLivraison(
    string $reception,
    string $adresse,
    string $ville,
    string $codePostal
): float {
    /* ========== Aucun frais hors livraison ========== */
    if ($reception !== 'livraison') {
        return 0;
    }

    /* ========== Forfait de base ========== */
    $frais = 5;

    /* ========== Livraison hors Bordeaux ========== */
    if (strtolower($ville) !== 'bordeaux') {

        $coords = geocoderAdresse(
            "$adresse $codePostal $ville"
        );

        if ($coords) {

            $distance = calculerDistanceKm(
                TRAITEUR_LAT,
                TRAITEUR_LON,
                $coords['lat'],
                $coords['lon']
            );

            $frais += $distance * 0.59;
        }
    }

    return $frais;
}
