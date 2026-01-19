<?php

/* ========== Vérification existence d’un avis ========== */

function avisExistePourCommande(PDO $pdo, int $commandeId): bool
{
    $stmt = $pdo->prepare("
        SELECT id FROM avis WHERE commande_id = :id
    ");
    $stmt->execute(['id' => $commandeId]);

    return (bool) $stmt->fetch();
}

/* ========== Insertion d’un avis ========== */

function insertAvis(PDO $pdo, int $commandeId, int $note, string $commentaire): void
{
    // Empêche les doublons d’avis pour une même commande
    if (avisExistePourCommande($pdo, $commandeId)) {
        throw new RuntimeException("Avis déjà existant pour cette commande.");
    }

    $stmt = $pdo->prepare("
        INSERT INTO avis (commande_id, note, commentaire)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([$commandeId, $note, $commentaire]);
}

/* ========== Récupération des avis validés (site public) ========== */

function getAvisValides(PDO $pdo, int $limit = 3): array
{
    $sql = "
        SELECT 
            a.note,
            a.commentaire,
            u.prenom,
            u.nom
        FROM avis a
        JOIN commande c ON a.commande_id = c.id
        JOIN utilisateur u ON c.utilisateur_id = u.id
        WHERE a.valide = 1
        ORDER BY a.id DESC
        LIMIT :limit
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/* ========== Récupération de tous les avis (admin) ========== */

function getAllAvis(PDO $pdo): array
{
    $sql = "
        SELECT 
            a.id,
            a.note,
            a.commentaire,
            a.valide,
            c.id AS commande_id,
            u.prenom,
            u.nom
        FROM avis a
        JOIN commande c ON a.commande_id = c.id
        JOIN utilisateur u ON c.utilisateur_id = u.id
        ORDER BY a.id DESC
    ";

    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

/* ========== Validation / invalidation d’un avis ========== */

function setAvisValide(PDO $pdo, int $avisId, bool $valide): void
{
    $stmt = $pdo->prepare("
        UPDATE avis
        SET valide = :valide
        WHERE id = :id
    ");

    $stmt->execute([
        'valide' => $valide ? 1 : 0,
        'id' => $avisId
    ]);
}
