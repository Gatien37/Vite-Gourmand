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
        <h1>Gestion des commandes</h1>
        <p>Consultez et mettez à jour les commandes clients.</p>
    </section>

    <section class="commandes-admin-container">
        <table class="commandes-admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Menu</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Mode</th>
                    <th>Statut</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- COMMANDE EXEMPLE 1 -->
                <tr>
                    <td>#CMD-1023</td>
                    <td>Claire M.</td>
                    <td>Menu Festif de Noël</td>
                    <td>24/12/2024</td>
                    <td>19h30</td>
                    <td>Livraison</td>
                    <td>
                        <select name="statut">
                            <option>En attente</option>
                            <option selected>En cours</option>
                            <option>Livrée</option>
                            <option>Annulée</option>
                        </select>
                    </td>
                    <td>199,20 €</td>
                    <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                </tr>
                <!-- COMMANDE EXEMPLE 2 -->
                <tr>
                    <td>#CMD-1001</td>
                    <td>Julien R.</td>
                    <td>Menu Saveurs du Monde</td>
                    <td>10/12/2024</td>
                    <td>12h00</td>
                    <td>Retrait</td>
                    <td>
                        <select name="statut">
                            <option selected>En attente</option>
                            <option>En cours</option>
                            <option>Livrée</option>
                            <option>Annulée</option>
                        </select>
                    </td>

                    <td>149,40 €</td>
                    <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                </tr>
                <!-- COMMANDE EXEMPLE 3 -->
                <tr>
                    <td>#CMD-0987</td>
                    <td>Sophie L.</td>
                    <td>Menu Cocktail Premium</td>
                    <td>02/11/2024</td>
                    <td>18h00</td>
                    <td>Livraison</td>

                    <td>
                        <select name="statut">
                            <option>En attente</option>
                            <option>En cours</option>
                            <option selected>Livrée</option>
                            <option>Annulée</option>
                        </select>
                    </td>
                    <td>179,90 €</td>
                    <td><a href="commande-detail.php" class="btn-commande">Détails</a></td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
