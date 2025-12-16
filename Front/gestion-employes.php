<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Accueil";
    require_once __DIR__ . '/partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/partials/header.php'; ?>

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
                    <th>ID</th>
                    <th>Nom & Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemple 1 -->
                <tr>
                    <td>1</td>
                    <td>Julie Martin</td>
                    <td>julie@viteetgourmand.fr</td>
                    <td>Administrateur</td>
                    <td><span class="status actif">Actif</span></td>
                    <td>
                        <a href="form-employe.php?id=1" class="btn-commande">Modifier</a>
                        <a href="#" class="btn-secondary">Désactiver</a>
                    </td>
                </tr>
                <!-- Exemple 2 -->
                <tr>
                    <td>2</td>
                    <td>José Durand</td>
                    <td>jose@viteetgourmand.fr</td>
                    <td>Employé</td>
                    <td><span class="status actif">Actif</span></td>
                    <td>
                        <a href="form-employe.php?id=2" class="btn-commande">Modifier</a>
                        <a href="#" class="btn-secondary">Désactiver</a>
                    </td>
                </tr>
                <!-- Exemple 3 -->
                <tr>
                    <td>3</td>
                    <td>Sarah Bernard</td>
                    <td>sarah@viteetgourmand.fr</td>
                    <td>Employé</td>
                    <td><span class="status inactif">Inactif</span></td>
                    <td>
                        <a href="form-employe.php?id=3" class="btn-commande">Modifier</a>
                        <a href="#" class="btn-secondary">Activer</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
