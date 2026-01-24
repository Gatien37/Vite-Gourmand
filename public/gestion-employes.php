<?php
/* ========== Sécurité : accès administrateur ========== */
require_once __DIR__ . '/../middlewares/requireAdmin.php';

/* ========== Génération CSRF ========== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/utilisateurModel.php';

/* ========== Récupération des employés ========== */
$employes = getEmployes($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Gestion des employés";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>

<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main id="main-content">

    <section class="hero-section commandes-hero">
        <h1>Gestion des employés</h1>
        <p>Ajoutez, modifiez ou désactivez des comptes employés.</p>
    </section>

    <div class="add-employe-container">
        <a href="form-employe.php" class="btn-commande">
            Ajouter un employé
        </a>
    </div>

    <section class="employes-admin-container">

        <table class="employes-admin-table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($employes as $employe): ?>
                    <tr>

                        <td><?= htmlspecialchars($employe['email']) ?></td>

                        <td>
                            <?php if ($employe['actif']): ?>
                                <span class="status actif">Actif</span>
                            <?php else: ?>
                                <span class="status inactif">Inactif</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <form
                                method="POST"
                                action="toggle-employe.php"
                            >
                                <input type="hidden" name="id" value="<?= (int) $employe['id'] ?>">
                                <input type="hidden" name="action"
                                       value="<?= $employe['actif'] ? 'disable' : 'enable' ?>">
                                <input type="hidden" name="csrf_token"
                                       value="<?= $_SESSION['csrf_token'] ?>">

                                <button
                                    type="submit"
                                    class="<?= $employe['actif'] ? 'btn-secondary btn-delete' : 'btn-commande' ?>"
                                >
                                    <?= $employe['actif'] ? 'Désactiver' : 'Activer' ?>
                                </button>
                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </section>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
