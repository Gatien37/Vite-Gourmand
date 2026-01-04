<?php

function getCommandeById(PDO $pdo, int $id): array|false
{
    $sql = "
        SELECT 
            c.id,
            c.date_prestation,
            c.adresse,
            c.ville,
            c.nb_personnes,
            c.prix_total,
            c.statut,
            m.nom AS menu_nom
        FROM commande c
        JOIN menu m ON c.menu_id = m.id
        WHERE c.id = :id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
