<?php

function getAllPlats(PDO $pdo): array
{
    $sql = "
        SELECT id, nom, type, actif
        FROM plat
        ORDER BY type, nom
    ";

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function togglePlat(PDO $pdo, int $platId, bool $actif): void
{
    $stmt = $pdo->prepare("
        UPDATE plat
        SET actif = :actif
        WHERE id = :id
    ");

    $stmt->execute([
        'actif' => $actif ? 1 : 0,
        'id' => $platId
    ]);
}


function getPlatById(PDO $pdo, int $id): array|false
{
    $stmt = $pdo->prepare("
        SELECT *
        FROM plat
        WHERE id = :id
    ");
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function savePlat(PDO $pdo, array $data, ?int $id = null): void
{
    if ($id) {
        $sql = "
            UPDATE plat
            SET nom = :nom,
                type = :type
            WHERE id = :id
        ";
    } else {
        $sql = "
            INSERT INTO plat (nom, type, actif)
            VALUES (:nom, :type, 1)
        ";
    }

    $stmt = $pdo->prepare($sql);

    $params = [
        'nom'  => $data['nom'],
        'type' => $data['type']
    ];

    if ($id) {
        $params['id'] = $id;
    }

    $stmt->execute($params);
}


function getMenusImpactesParPlat(PDO $pdo, int $platId): array
{
    $sql = "
        SELECT m.id, m.nom
        FROM menu m
        INNER JOIN menu_plat mp ON m.id = mp.menu_id
        WHERE mp.plat_id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$platId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
