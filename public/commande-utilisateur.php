<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Accueil";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1>Mes commandes</h1>
        <p>Consultez vos commandes passées et en cours.</p>
    </section>

    <section class="orders-container">
        <div class="table-wrapper">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Menu</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Exemple 1 -->
                    <tr>
                        <td>#CMD-1023</td>
                        <td>Menu Festif de Noël</td>
                        <td>24/12/2024</td>
                        <td><span class="status en-cours">En cours</span></td>
                        <td>199,20 €</td>
                        <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                    </tr>
                    <!-- Exemple 2 -->
                    <tr>
                        <td>#CMD-0987</td>
                        <td>Menu Saveurs du Monde</td>
                        <td>10/11/2024</td>
                        <td><span class="status livre">Livrée</span></td>
                        <td>149,40 €</td>
                        <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                    </tr>
                    <!-- Exemple 3 -->
                    <tr>
                        <td>#CMD-0874</td>
                        <td>Menu Cocktail Premium</td>
                        <td>02/10/2024</td>
                        <td><span class="status annulee">Annulée</span></td>
                        <td>0,00 €</td>
                        <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
