<?php
require_once __DIR__ . '/../services/mailService.php';

function creerEmploye(PDO $pdo, array $data): array
{
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';
    $confirm = $data['confirm_password'] ?? '';

    if (!$email || !$password || !$confirm) {
        return ['error' => 'Tous les champs sont obligatoires.'];
    }

    if ($password !== $confirm) {
        return ['error' => 'Les mots de passe ne correspondent pas.'];
    }

    // Email déjà utilisé
    $stmt = $pdo->prepare("SELECT id FROM utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        return ['error' => 'Email déjà utilisé.'];
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO utilisateur (email, mot_de_passe, role, actif)
        VALUES (?, ?, 'employe', 1)
    ");
    $stmt->execute([$email, $hash]);

    return ['success' => true];

}
