<?php

function getUtilisateurByEmail(PDO $pdo, string $email): ?array
{
    $sql = "SELECT * FROM utilisateur WHERE email = :email AND actif = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;
}
