<?php

function getUtilisateurByEmail(PDO $pdo, string $email): ?array
{
    $sql = "SELECT * FROM utilisateur WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;
}

function getUtilisateurById(PDO $pdo, int $id): ?array
{
    $sql = "
        SELECT id, prenom, nom, email, gsm, adresse, ville, code_postal
        FROM utilisateur
        WHERE id = :id
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;
}

function updateAdresseUtilisateur(PDO $pdo, int $id, array $data): void
{
    $sql = "
        UPDATE utilisateur
        SET adresse = :adresse,
            ville = :ville,
            code_postal = :code_postal
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'adresse' => $data['adresse'],
        'ville' => $data['ville'],
        'code_postal' => $data['code_postal'],
        'id' => $id
    ]);
}
