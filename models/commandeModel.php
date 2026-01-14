<?php

function getCommandeById(PDO $pdo, int $id): array|false
{
    $sql = "
        SELECT 
            c.id,
            c.utilisateur_id,
            c.menu_id,
            c.date_prestation,
            c.adresse,
            c.ville,
            c.nb_personnes AS quantite,
            c.prix_total,
            c.statut,

            u.nom AS client_nom,
            u.email AS client_email,
            u.gsm AS client_gsm,

            m.nom AS menu_nom,
            m.prix_base,
            m.nb_personnes_min,
            m.stock
        FROM commande c
        JOIN menu m ON c.menu_id = m.id
        JOIN utilisateur u ON c.utilisateur_id = u.id
        WHERE c.id = :id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}





function getCommandeSuivi(PDO $pdo, int $commandeId): array
{
    $sql = "
        SELECT statut, date_statut
        FROM commande_suivi
        WHERE commande_id = :id
        ORDER BY date_statut ASC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $commandeId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



function updateCommande(PDO $pdo, int $commandeId, array $data): void
{
    $sql = "
        UPDATE commande
        SET date_prestation = :date_prestation,
            adresse = :adresse,
            ville = :ville,
            nb_personnes = :nb_personnes,
            prix_total = :prix_total
        WHERE id = :id
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'date_prestation' => $data['date_prestation'],
        'adresse' => $data['adresse'],
        'ville' => $data['ville'],
        'nb_personnes' => $data['nb_personnes'],
        'prix_total' => $data['prix_total'],
        'id' => $commandeId
    ]);
}

function insertCommandeSuivi(PDO $pdo, int $commandeId, string $statut): void
{
    $sql = "INSERT INTO commande_suivi (commande_id, statut) VALUES (:id, :statut)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $commandeId, 'statut' => $statut]);
}





function getCommandesByUtilisateur(PDO $pdo, int $utilisateurId): array
{
    $sql = "
        SELECT 
            c.id,
            c.date_prestation,
            c.prix_total,
            c.statut,
            c.pret_materiel,
            c.date_limite_retour,
            m.nom AS menu_nom
        FROM commande c
        JOIN menu m ON c.menu_id = m.id
        WHERE c.utilisateur_id = :utilisateur_id
        ORDER BY c.date_prestation DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['utilisateur_id' => $utilisateurId]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




function getAllCommandesAvecDetails(PDO $pdo): array
{
    $sql = "
        SELECT
            c.id,
            c.date_prestation,
            c.prix_total,
            c.statut,
            c.pret_materiel,
            c.date_limite_retour,
            u.nom AS client_nom,
            u.prenom AS client_prenom,
            m.nom AS menu_nom
        FROM commande c
        JOIN utilisateur u ON c.utilisateur_id = u.id
        JOIN menu m ON c.menu_id = m.id
        ORDER BY c.date_prestation DESC
    ";

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getCommandesFiltrees(PDO $pdo, ?string $statut, ?string $client): array
{
    $sql = "
        SELECT 
            c.id,
            c.date_prestation,
            c.prix_total,
            c.statut,
            u.nom AS client_nom,
            u.email AS client_email,
            m.nom AS menu_nom
        FROM commande c
        JOIN utilisateur u ON c.utilisateur_id = u.id
        JOIN menu m ON c.menu_id = m.id
        WHERE 1 = 1
    ";

    $params = [];

    if (!empty($statut)) {
        $sql .= " AND c.statut = :statut";
        $params['statut'] = $statut;
    }

    if (!empty($client)) {
        $sql .= " AND (u.nom LIKE :client OR u.email LIKE :client)";
        $params['client'] = '%' . $client . '%';
    }

    $sql .= " ORDER BY c.date_prestation DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getMotifAnnulation(PDO $pdo, int $commandeId): ?array
{
    $sql = "
        SELECT motif, contact_mode, created_at
        FROM commande_actions
        WHERE commande_id = :commande_id
          AND action = 'annuler'
        ORDER BY created_at DESC
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'commande_id' => $commandeId
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}


function getDerniereModificationCommande(PDO $pdo, int $commandeId): ?array
{
    $sql = "
        SELECT contact_mode, motif, created_at
        FROM commande_actions
        WHERE commande_id = :commande_id
          AND action = 'modifier'
        ORDER BY created_at DESC
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'commande_id' => $commandeId
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}
