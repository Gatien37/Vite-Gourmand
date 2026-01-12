<?php

function getFilteredMenus(PDO $pdo, array $filters): array
{
    $sql = "
        SELECT id, nom, description, nb_personnes_min, image, prix_base
        FROM menu
        WHERE 1=1
    ";

    $params = [];

    if (!empty($filters['theme'])) {
        $sql .= " AND theme = :theme";
        $params['theme'] = $filters['theme'];
    }

    if (!empty($filters['regime'])) {
        $sql .= " AND regime = :regime";
        $params['regime'] = $filters['regime'];
    }

    if (!empty($filters['nb_personnes_min'])) {
        $sql .= " AND nb_personnes_min <= :nbMin";
        $params['nbMin'] = (int)$filters['nb_personnes_min'];
    }

    if (!empty($filters['prix_max'])) {
        $sql .= " AND prix_base <= :prixMax";
        $params['prixMax'] = (float)$filters['prix_max'];
    }

    if (!empty($filters['fourchette_prix'])) {
        [$min, $max] = explode('-', $filters['fourchette_prix']);
        $sql .= " AND prix_base BETWEEN :prixMin AND :prixMaxRange";
        $params['prixMin'] = (float)$min;
        $params['prixMaxRange'] = (float)$max;
    }

    if (empty($params)) {
        $sql = "
            SELECT id, nom, description, nb_personnes_min, image, prix_base
            FROM menu
        ";
    }


    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getMenuById(PDO $pdo, int $id): array|false
{
    $sql = "SELECT * FROM menu WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getPlatsByMenu(PDO $pdo, int $menuId): array
{
    $sql = "
        SELECT p.*
        FROM plat p
        INNER JOIN menu_plat mp ON p.id = mp.plat_id
        WHERE mp.menu_id = :menu_id
        ORDER BY FIELD(p.type, 'entree', 'plat', 'dessert')
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['menu_id' => $menuId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllergenesByMenu(PDO $pdo, int $menuId): array
{
    $sql = "
        SELECT DISTINCT a.nom
        FROM allergene a
        INNER JOIN plat_allergene pa ON pa.allergene_id = a.id
        INNER JOIN menu_plat mp ON mp.plat_id = pa.plat_id
        WHERE mp.menu_id = :menu_id
        ORDER BY a.nom
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['menu_id' => $menuId]);

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}


function getAllMenus(PDO $pdo): array
{
    $sql = "
        SELECT id, nom, theme, regime, prix_base
        FROM menu
        ORDER BY id DESC
    ";

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function deleteMenu(PDO $pdo, int $menuId): void
{
    $stmt = $pdo->prepare("DELETE FROM menu WHERE id = ?");
    $stmt->execute([$menuId]);
}

function saveMenu(PDO $pdo, array $data, ?int $menuId = null): void
{
    if ($menuId) {
        $sql = "
            UPDATE menu SET
                nom = :nom,
                description = :description,
                description_longue = :description_longue,
                theme = :theme,
                regime = :regime,
                nb_personnes_min = :nb_min,
                prix_base = :prix,
                stock = :stock
            WHERE id = :id
        ";
    } else {
        $sql = "
            INSERT INTO menu
            (nom, description, description_longue, theme, regime, nb_personnes_min, prix_base, stock)
            VALUES
            (:nom, :description, :description_longue, :theme, :regime, :nb_min, :prix, :stock)
        ";
    }

    $stmt = $pdo->prepare($sql);

    $params = [
        'nom' => $data['nom'],
        'description' => $data['description'],
        'description_longue' => $data['description_longue'],
        'theme' => $data['theme'],
        'regime' => $data['regime'],
        'nb_min' => (int)$data['nb_personnes_min'],
        'prix' => (float)$data['prix_base'],
        'stock' => (int)$data['stock'],
    ];

    if ($menuId) {
        $params['id'] = $menuId;
    }

    $stmt->execute($params);
}
