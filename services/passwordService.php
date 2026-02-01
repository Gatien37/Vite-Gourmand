<?php
require_once __DIR__ . '/mailService.php';

/* =====================================================
   DEMANDE DE RÉINITIALISATION DE MOT DE PASSE
   ===================================================== */

function traiterDemandeReinitialisation(PDO $pdo, string $email): void
{
    /* Validation email (silencieuse pour éviter l’énumération) */
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return;
    }

    /* Recherche utilisateur */
    $stmt = $pdo->prepare("
        SELECT id
        FROM utilisateur
        WHERE email = ?
    ");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    /* Email inexistant → sortie silencieuse */
    if (!$user) {
        return;
    }

    /* Génération token sécurisé */
    $token = bin2hex(random_bytes(32));

    /* Expiration à +1h */
    $expires = date('Y-m-d H:i:s', time() + 3600);

    /* Stockage token + expiration */
    $stmt = $pdo->prepare("
        UPDATE utilisateur 
        SET reset_token = ?, reset_expires = ?
        WHERE email = ?
    ");
    $stmt->execute([$token, $expires, $email]);

    /* Lien de réinitialisation */
        $baseUrl = getenv('APP_URL') ?: 'http://localhost/vite-gourmand/public';
        $resetLink = $baseUrl . "/nouveau-mot-de-passe.php?token=$token";

    /* Envoi email */
    envoyerMailResetMotDePasse($email, $resetLink);
}

/* =====================================================
   VÉRIFICATION DU TOKEN
   ===================================================== */

function verifierTokenReset(PDO $pdo, string $token): ?array
{
    $stmt = $pdo->prepare("
        SELECT id, reset_expires
        FROM utilisateur
        WHERE reset_token = ?
    ");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    /* Token inexistant ou expiré */
    if (
        !$user ||
        strtotime($user['reset_expires']) < time()
    ) {
        return null;
    }

    return $user;
}

/* =====================================================
   MISE À JOUR DU MOT DE PASSE
   ===================================================== */

function traiterNouveauMotDePasse(PDO $pdo, int $userId, array $post): ?string
{
    $password = $post['password'] ?? '';
    $confirm  = $post['confirm_password'] ?? '';

    /* Correspondance */
    if ($password !== $confirm) {
        return "Les mots de passe ne correspondent pas.";
    }

    /* Longueur minimale */
    if (strlen($password) < 10) {
        return "Le mot de passe doit contenir au moins 10 caractères.";
    }

    /* Hash sécurisé */
    $hash = password_hash($password, PASSWORD_DEFAULT);

    /* Mise à jour + invalidation du token */
    $stmt = $pdo->prepare("
        UPDATE utilisateur
        SET
            mot_de_passe = ?,
            reset_token = NULL,
            reset_expires = NULL
        WHERE id = ?
    ");
    $stmt->execute([$hash, $userId]);

    return null;
}
