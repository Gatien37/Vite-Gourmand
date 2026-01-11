<?php

function getHoraires(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT jour, ouverture, fermeture FROM horaire ORDER BY id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateHoraire(PDO $pdo, string $jour, ?string $ouverture, ?string $fermeture): void
{
    $stmt = $pdo->prepare("
        UPDATE horaire
        SET ouverture = :ouverture,
            fermeture = :fermeture
        WHERE jour = :jour
    ");

    $stmt->execute([
        'ouverture' => $ouverture,
        'fermeture' => $fermeture,
        'jour' => $jour
    ]);
}
