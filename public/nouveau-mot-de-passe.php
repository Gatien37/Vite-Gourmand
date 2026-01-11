<?php
require_once __DIR__ . '/../config/database.php';

$message = '';
$token = $_GET['token'] ?? null;

if (!$token) {
    $message = "Lien de réinitialisation invalide.";
} else {
    // Vérifier le token
    $stmt = $pdo->prepare("
        SELECT id, reset_expires 
        FROM utilisateur 
        WHERE reset_token = ?
    ");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if (!$user || strtotime($user['reset_expires']) < time()) {
        $message = "Lien de réinitialisation expiré ou invalide.";
    } else {

        // Traitement du formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';

            if ($password !== $confirm) {
                $message = "Les mots de passe ne correspondent pas.";
            } elseif (strlen($password) < 10) {
                $message = "Le mot de passe doit contenir au moins 10 caractères.";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("
                    UPDATE utilisateur 
                    SET mot_de_passe = ?, reset_token = NULL, reset_expires = NULL
                    WHERE id = ?
                ");
                $stmt->execute([$hash, $user['id']]);

                $message = "Votre mot de passe a été réinitialisé avec succès.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Accueil";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1>Nouveau mot de passe</h1>
        <p>Saisissez votre nouveau mot de passe ci-dessous.</p>
    </section>

    <section class="reset-container">
        <?php if ($token && empty($message) || $_SERVER['REQUEST_METHOD'] === 'POST'): ?>

            <form class="reset-form form-card" action="#" method="POST">

                <?php if (!empty($message)): ?>
                    <p class="alert-success"><?= htmlspecialchars($message) ?></p>
                <?php endif; ?>


                <label for="password">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" required placeholder="Votre nouveau mot de passe">
                <label for="confirm-password">Confirmer le mot de passe</label>
                <input type="password" id="confirm-password" name="confirm_password" required placeholder="Confirmez le mot de passe">
                <button type="submit" class="btn-commande">Réinitialiser le mot de passe</button>
                <div class="auth-links">
                    <a href="connexion.php">Retour à la connexion</a>
                </div>
            </form>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>