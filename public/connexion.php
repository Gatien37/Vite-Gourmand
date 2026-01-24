<?php
/* ========== Sécurisation cookies de session ========== */
session_set_cookie_params([
    'httponly' => true,
    'secure'   => true,   // à laisser à true en HTTPS
    'samesite' => 'Strict'
]);

/* ========== Initialisation de la session ========== */
session_start();

/* ========== Génération du token CSRF ========== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/utilisateurModel.php';

/* ========== Paramètres de redirection éventuelle ========== */
$redirect = $_GET['redirect'] ?? null;
$menuId   = $_GET['menu_id'] ?? null;

/* ========== Initialisation des erreurs ========== */
$error = null;

/* ========== Traitement du formulaire de connexion ========== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ===== Vérification CSRF ===== */
    if (
        empty($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die('Action non autorisée.');
    }

    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    /* Récupération de l’utilisateur par email */
    $user = getUtilisateurByEmail($pdo, $email);

    /* Vérifications successives */
    if (!$user) {
        $error = "Email ou mot de passe incorrect.";
    }
    elseif (!$user['actif']) {
        $error = "Ce compte est désactivé.";
    }
    elseif (!password_verify($password, $user['mot_de_passe'])) {
        $error = "Email ou mot de passe incorrect.";
    }
    else {

        /* Sécurisation de la session */
        session_regenerate_id(true);

        /* Stockage des informations utilisateur en session */
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'email' => $user['email'],
            'role'  => $user['role']
        ];

        /* Redirection vers la commande si connexion forcée */
        if ($redirect === 'commande' && $menuId) {
            header('Location: commande.php?menu_id=' . (int) $menuId);
            exit;
        }

        /* Redirection selon le rôle */
        switch ($user['role']) {
            case 'admin':
                header('Location: espace-admin.php');
                break;

            case 'employe':
                header('Location: espace-employe.php');
                break;

            default:
                header('Location: espace-utilisateur.php');
                break;
        }

        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Connexion";
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
        <h1>Connexion</h1>
        <p>Accédez à votre espace personnel.</p>
    </section>

    <section class="login-container">

        <!-- Message de succès -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Message d’erreur -->
        <?php if (!empty($error)): ?>
            <div class="alert-error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form class="login-form form-card" method="POST">

            <!-- CSRF -->
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <label for="email">Adresse e-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="exemple@mail.com"
                required
            >

            <label for="password">Mot de passe</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Votre mot de passe"
                required
            >

            <button type="submit" class="btn-commande">
                Se connecter
            </button>

            <div class="auth-links">
                <a href="mot-de-passe-oublie.php">Mot de passe oublié ?</a>
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
