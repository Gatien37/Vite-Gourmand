<?php
/* ========== Initialisation de la session ========== */

session_start();

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../services/mailService.php';
require_once __DIR__ . '/../services/inscriptionService.php';

/* ========== Initialisation des états ========== */

$error   = null;
$success = false;

/* ========== Traitement du formulaire d’inscription ========== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = traiterInscription($pdo, $_POST);

    if (!empty($result['error'])) {
        $error = $result['error'];
    } else {

        $_SESSION['success'] = "Compte créé avec succès. Vous pouvez vous connecter.";

        header('Location: connexion.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Inscription";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php
/* ========== En-tête du site ========== */
require_once __DIR__ . '/../partials/header.php';
?>

<main id="main-content">

    <!-- ===== Titre ===== -->
    <section class="hero-section commandes-hero">
        <h1>Créer un compte</h1>
        <p>Rejoignez Vite & Gourmand et commandez vos menus en quelques clics&nbsp;!</p>
    </section>

    <section class="register-container">

        <!-- ===== Formulaire d’inscription ===== -->
        <form
            id="register-form"
            class="register-form form-card"
            action="#"
            method="POST"
        >

            <!-- Message d’erreur -->
            <?php if ($error): ?>
                <p id="form-errors"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <h2>Informations personnelles</h2>

            <label for="prenom">Prénom <span class="required">*</span></label>
            <input
                type="text"
                id="prenom"
                name="prenom"
                placeholder="Votre prénom"
            >

            <label for="nom">Nom <span class="required">*</span></label>
            <input
                type="text"
                id="nom"
                name="nom"
                placeholder="Votre nom"
            >

            <label for="email">Adresse e-mail <span class="required">*</span></label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="exemple@mail.com"
            >

            <label for="telephone">Téléphone <span class="required">*</span></label>
            <input
                type="text"
                id="telephone"
                name="telephone"
                placeholder="Votre numéro de téléphone"
            >

            <label for="adresse">Adresse <span class="required">*</span></label>
            <input
                type="text"
                id="adresse"
                name="adresse"
                placeholder="Votre adresse"
            >

            <label for="ville">Ville <span class="required">*</span></label>
            <input
                type="text"
                id="ville"
                name="ville"
                placeholder="Votre ville"
            >

            <label for="code-postal">Code postal <span class="required">*</span></label>
            <input
                type="text"
                id="code-postal"
                name="code_postal"
                placeholder="Code postal"
            >

            <h2>Sécurité du compte</h2>

            <label for="password">Mot de passe <span class="required">*</span></label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Votre mot de passe"
            >

            <!-- Règles de sécurité du mot de passe -->
            <ul class="password-rules" id="password-rules">
                <li data-rule="length">❌ 10 caractères minimum</li>
                <li data-rule="uppercase">❌ Une majuscule</li>
                <li data-rule="lowercase">❌ Une minuscule</li>
                <li data-rule="number">❌ Un chiffre</li>
                <li data-rule="special">❌ Un caractère spécial</li>
            </ul>

            <label for="confirm-password">
                Confirmer le mot de passe <span class="required">*</span>
            </label>
            <input
                type="password"
                id="confirm-password"
                name="confirm_password"
                placeholder="Confirmez le mot de passe"
            >

            <button type="submit" class="btn-commande">
                Créer mon compte
            </button>

            <div class="auth-links">

                <p class="required-info">
                    <span class="required">*</span> Champs obligatoires
                </p>

                <a href="connexion.php">Déjà un compte ? Se connecter</a>
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
