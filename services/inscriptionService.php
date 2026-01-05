<?php
require_once __DIR__ . '/../services/mailService.php';

function traiterInscription(PDO $pdo, array $data): array
{
    // Récupération
    $prenom = trim($data['prenom'] ?? '');
    $nom = trim($data['nom'] ?? '');
    $email = trim($data['email'] ?? '');
    $telephone = trim($data['telephone'] ?? '');
    $adresse = trim($data['adresse'] ?? '');
    $ville = trim($data['ville'] ?? '');
    $codePostal = trim($data['code_postal'] ?? '');
    $password = $data['password'] ?? '';
    $confirmPassword = $data['confirm_password'] ?? '';

    // Vérifications
    if (
        !$prenom || !$nom || !$email || !$telephone ||
        !$adresse || !$ville || !$codePostal ||
        !$password || !$confirmPassword
    ) {
        return ['error' => 'Tous les champs obligatoires doivent être remplis.'];
    }

    if ($password !== $confirmPassword) {
        return ['error' => 'Les mots de passe ne correspondent pas.'];
    }

    if (!preg_match(
        '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{10,}$/',
        $password
    )) {
        return ['error' => 'Mot de passe trop faible.'];
    }

    // Email déjà utilisé
    $stmt = $pdo->prepare("SELECT id FROM utilisateur WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        return ['error' => 'Cette adresse email est déjà utilisée.'];
    }

    // Insertion
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO utilisateur 
        (nom, prenom, email, mot_de_passe, gsm, adresse, ville, code_postal, role)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'user')
    ");

    $stmt->execute([
        $nom,
        $prenom,
        $email,
        $hash,
        $telephone,
        $adresse,
        $ville,
        $codePostal
    ]);

    envoyerMailBienvenue($email, $prenom);

    return ['success' => true];
}
