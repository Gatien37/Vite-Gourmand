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
        <h1>Gestion des menus</h1>
        <p>Ajoutez, modifiez ou supprimez les menus disponibles.</p>
    </section>

        <!-- Bouton ajouter -->
        <div class="add-menu-container">
            <a href="form-menu.php" class="btn-commande"> Ajouter un menu</a>
        </div>
    <section class="menus-admin-container">
        <!-- Tableau des menus -->
        <table class="menus-admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du menu</th>
                    <th>Prix / pers.</th>
                    <th>Thème</th>
                    <th>Régime</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemple 1 -->
                <tr>
                    <td>1</td>
                    <td>Menu Festif de Noël</td>
                    <td>24,90 €</td>
                    <td>Noël</td>
                    <td>Classique</td>
                    <td>
                        <a href="form-menu.php?id=1" class="btn-commande">Modifier</a>
                        <a href="#" class="btn-secondary">Supprimer</a>
                    </td>
                </tr>
                <!-- Exemple 2 -->
                <tr>
                    <td>2</td>
                    <td>Menu Vegan Savoureux</td>
                    <td>19,90 €</td>
                    <td>Vegan</td>
                    <td>Végétalien</td>
                    <td>
                        <a href="form-menu.php?id=2" class="btn-commande">Modifier</a>
                        <a href="#" class="btn-secondary">Supprimer</a>
                    </td>
                </tr>
                <!-- Exemple 3 -->
                <tr>
                    <td>3</td>
                    <td>Menu Saveurs du Monde</td>
                    <td>22,50 €</td>
                    <td>International</td>
                    <td>Classique</td>
                    <td>
                        <a href="form-menu.php?id=3" class="btn-commande">Modifier</a>
                        <a href="#" class="btn-secondary">Supprimer</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
