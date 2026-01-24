<?php
/* ========== Initialisation de la session ========== */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ========== Génération du token CSRF ========== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ========== Sécurité : accès employé ou administrateur ========== */
require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/avisModel.php';

/* ========== Récupération des avis clients ========== */
$avisList = getAllAvis($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    /* ========== Métadonnées ========== */
    $title = "Gestion des avis";
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
        <h1>Gestion des avis</h1>
        <p>Validez ou refusez les avis déposés par les clients.</p>
    </section>

    <section class="avis-admin-container">

        <!-- ===== Messages retour ===== -->
        <?php if (!empty($_SESSION['success'])): ?>
            <p class="alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
            </p>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error'])): ?>
            <p class="error-message">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- ===== Tableau des avis ===== -->
        <table class="avis-admin-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Commande</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($avisList as $avis): ?>
                    <tr>

                        <td>#<?= (int) $avis['id'] ?></td>

                        <td>
                            <?= htmlspecialchars($avis['prenom'] . ' ' . $avis['nom']) ?>
                        </td>

                        <td>
                            #<?= (int) $avis['commande_id'] ?>
                        </td>

                        <td>
                            <?= str_repeat('⭐', (int) $avis['note']) ?>
                        </td>

                        <td>
                            <?= nl2br(htmlspecialchars($avis['commentaire'])) ?>
                        </td>

                        <td>
                            <?php if ($avis['valide']): ?>
                                <span class="status valide">Validé</span>
                            <?php else: ?>
                                <span class="status attente">En attente</span>
                            <?php endif; ?>
                        </td>

                        <td>

                            <?php if (!$avis['valide']): ?>
                                <!-- Valider -->
                                <form method="POST" action="toggle-avis.php">
                                    <input type="hidden" name="id" value="<?= (int) $avis['id'] ?>">
                                    <input type="hidden" name="action" value="valider">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                    <button type="submit" class="btn-commande">
                                        Valider
                                    </button>
                                </form>
                            <?php endif; ?>

                            <?php if ($avis['valide']): ?>
                                <!-- Refuser -->
                                <form method="POST" action="toggle-avis.php">
                                    <input type="hidden" name="id" value="<?= (int) $avis['id'] ?>">
                                    <input type="hidden" name="action" value="refuser">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                    <button type="submit" class="btn-secondary btn-delete">
                                        Refuser
                                    </button>
                                </form>
                            <?php endif; ?>

                        </td>

                    </tr>
                <?php endforeach; ?>

            </tbody>

        </table>
    </section>
</main>

<?php
/* ========== Pied de page ========== */
require_once __DIR__ . '/../partials/footer.php';
?>

</body>
</html>
