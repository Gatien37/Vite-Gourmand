<?php
require_once __DIR__ . '/mailService.php';

function traiterDemandeReinitialisation(PDO $pdo, string $email): void
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return;
    }

    $stmt = $pdo->prepare("SELECT id FROM utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        return;
    }

    $token = bin2hex(random_bytes(32));
    $expires = date('Y-m-d H:i:s', time() + 3600);

    $stmt = $pdo->prepare("
        UPDATE utilisateur 
        SET reset_token = ?, reset_expires = ?
        WHERE email = ?
    ");
    $stmt->execute([$token, $expires, $email]);

    $resetLink = "http://localhost/vite-gourmand/public/nouveau-mot-de-passe.php?token=$token";

    envoyerMailResetMotDePasse($email, $resetLink);
}


function verifierTokenReset(PDO $pdo, string $token): ?array
{
    $stmt = $pdo->prepare("
        SELECT id, reset_expires 
        FROM utilisateur 
        WHERE reset_token = ?
    ");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if (!$user || strtotime($user['reset_expires']) < time()) {
        return null;
    }

    return $user;
}


function traiterNouveauMotDePasse(PDO $pdo, int $userId, array $post): ?string
{
    $password = $post['password'] ?? '';
    $confirm  = $post['confirm_password'] ?? '';

    if ($password !== $confirm) {
        return "Les mots de passe ne correspondent pas.";
    }

    if (strlen($password) < 10) {
        return "Le mot de passe doit contenir au moins 10 caractères.";
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        UPDATE utilisateur
        SET mot_de_passe = ?, reset_token = NULL, reset_expires = NULL
        WHERE id = ?
    ");
    $stmt->execute([$hash, $userId]);

    return null;
}

