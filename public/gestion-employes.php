<?php
/* ========== Sécurité : accès administrateur ========== */

require_once __DIR__ . '/../middlewares/requireAdmin.php';

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
    /* ========== Métadonnées ========== */
    $title = "Gestion des employés";
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
        <h1>Gestion des employés</h1>
        <p>Ajoutez, modifiez ou désactivez des comptes employés.</p>
    </section>

    <!-- ===== Ajout d’un employé ===== -->
    <div class="add-employe-container">
        <a href="form-employe.php" class="btn-commande">
            Ajouter un employé
        </a>
    </div>

    <!-- ===== Liste des employés ===== -->
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

                        <!-- Email -->
                        <td><?= htmlspecialchars($employe['email']) ?></td>

                        <!-- Statut -->
                        <td>
                            <?php if ($employe['actif']): ?>
                                <span class="status actif">Actif</span>
                            <?php else: ?>
                                <span class="status inactif">Inactif</span>
                            <?php endif; ?>
                        </td>

                        <!-- Actions -->
                        <td>
                            <?php if ($employe['actif']): ?>
                                <a
                                    href="toggle-employe.php?id=<?= (int) $employe['id'] ?>&action=disable"
                                    class="btn-secondary btn-delete"
                                >
                                    Désactiver
                                </a>
                            <?php else: ?>
                                <a
                                    href="toggle-employe.php?id=<?= (int) $employe['id'] ?>&action=enable"
                                    class="btn-commande"
                                >
                                    Activer
                                </a>
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
