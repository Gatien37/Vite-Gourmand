<?php
require_once __DIR__ . '/../middlewares/requireAdmin.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/utilisateurModel.php';

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

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1>Gestion des employés</h1>
        <p>Ajoutez, modifiez ou désactivez des comptes employés.</p>
    </section>

        <!-- Bouton ajouter employé -->
        <div class="add-employe-container">
            <a href="form-employe.php" class="btn-commande"> Ajouter un employé</a>
        </div>

    <section class="employes-admin-container">
        <!-- Tableau des employés -->
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
                    <?php if ($employe['actif']): ?>
                        <a href="toggle-employe.php?id=<?= $employe['id'] ?>&action=disable"
                        class="btn-secondary btn-delete">Désactiver</a>
                    <?php else: ?>
                        <a href="toggle-employe.php?id=<?= $employe['id'] ?>&action=enable"
                        class="btn-commande">Activer</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
