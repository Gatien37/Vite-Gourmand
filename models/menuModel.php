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

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
