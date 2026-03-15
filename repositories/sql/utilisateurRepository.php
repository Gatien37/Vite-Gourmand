<?php

/* ========== Utilisateur par email ========== */

function getUtilisateurByEmail(PDO $pdo, string $email): ?array
{
    $stmt = $pdo->prepare("
        SELECT *
        FROM utilisateur
        WHERE email = :email
    ");
    $stmt->execute(['email' => $email]);

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

/* ========== Utilisateur par ID ========== */

function getUtilisateurById(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare("
        SELECT id, prenom, nom, email, gsm, adresse, ville, code_postal
        FROM utilisateur
        WHERE id = :id
    ");
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

/* ========== Mise à jour de l’adresse utilisateur ========== */

function updateAdresseUtilisateur(PDO $pdo, int $id, array $data): void
{
    $stmt = $pdo->prepare("
        UPDATE utilisateur
        SET adresse = :adresse,
            ville = :ville,
            code_postal = :code_postal
        WHERE id = :id
    ");

    $stmt->execute([
        'adresse' => $data['adresse'],
        'ville' => $data['ville'],
        'code_postal' => $data['code_postal'],
        'id' => $id
    ]);
}

/* ========== Liste des employés ========== */

function getEmployes(PDO $pdo): array
{
    return $pdo->query("
        SELECT id, prenom, nom, email, actif
        FROM utilisateur
        WHERE role = 'employe'
        ORDER BY nom
    ")->fetchAll(PDO::FETCH_ASSOC);
}
