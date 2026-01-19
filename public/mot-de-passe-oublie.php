<?php
/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../services/passwordService.php';

/* ========== Initialisation des messages ========== */

$message = '';

/* ========== Traitement de la demande de réinitialisation ========== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');

    /* 
       Traitement volontairement neutre :
       aucune indication sur l’existence réelle du compte
    */
    traiterDemandeReinitialisation($pdo, $email);

    $message = "Si un compte existe avec cette adresse, un e-mail a été envoyé.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Mot de passe oublié";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <!-- ===== Titre de la page ===== -->
    <section class="hero-section commandes-hero">
        <h1>Mot de passe oublié</h1>
        <p>Entrez votre adresse e-mail pour recevoir un lien de réinitialisation.</p>
    </section>

    <section class="forgot-container">

        <!-- ===== Formulaire de réinitialisation ===== -->
        <form
            class="forgot-form form-card"
            action="#"
            method="POST"
        >

            <!-- Message de confirmation -->
            <?php if (!empty($message)): ?>
                <p class="alert-success"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <label for="email">Adresse e-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                required
                placeholder="exemple@mail.com"
            >

            <button type="submit" class="btn-commande">
                Réinitialiser le mot de passe
            </button>

            <div class="auth-links">
                <a href="connexion.php">Retour à la connexion</a>
                <a href="inscription.php">Créer un compte</a>
            </div>

        </form>
    </section>
</main>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
