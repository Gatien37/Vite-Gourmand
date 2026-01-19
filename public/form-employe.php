<?php
/* ========== Sécurité : accès administrateur ========== */

require_once __DIR__ . '/../middlewares/requireAdmin.php';

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../services/employeService.php';

/* ========== Initialisation des erreurs ========== */

$error = null;

/* ========== Traitement du formulaire de création employé ========== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = creerEmploye($pdo, $_POST);

    if (!empty($result['error'])) {
        $error = $result['error'];
    } else {
        header('Location: gestion-employes.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Créer employé";
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
        <h1>Créer un employé</h1>
        <p>Création d'un compte employé.</p>
    </section>

    <section class="employe-form-container">

        <!-- ===== Formulaire de création employé ===== -->
        <form method="POST" class="employe-form form-card">

            <!-- Message d’erreur -->
            <?php if ($error): ?>
                <p class="alert-error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <label>Email *</label>
            <input type="email" name="email" required>

            <label>Mot de passe *</label>
            <input type="password" name="password" required>

            <label>Confirmer le mot de passe *</label>
            <input type="password" name="confirm_password" required>

            <button class="btn-commande">
                Créer l'employé
            </button>

            <div class="auth-links">
                <a href="gestion-employes.php">← Retour</a>
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
