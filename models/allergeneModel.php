<?php

function getAllAllergenes(PDO $pdo): array
{
    $sql = "SELECT id, nom FROM allergene ORDER BY nom";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
