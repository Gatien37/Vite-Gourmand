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
        <h1>Gestion des avis</h1>
        <p>Validez ou refusez les avis déposés par les clients.</p>
    </section>

    <section class="avis-admin-container">
        <table class="avis-admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Menu</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- AVIS EXEMPLE 1 -->
                <tr>
                    <td>#AV-452</td>
                    <td>Claire M.</td>
                    <td>Menu Festif de Noël</td>
                    <td>⭐⭐⭐⭐⭐</td>
                    <td>“Menu délicieux, tout était parfait !”</td>
                    <td>25/12/2024</td>
                    <td><span class="status attente">En attente</span></td>
                    <td>
                        <a href="#" class="btn-commande">Valider</a>
                        <a href="#" class="btn-secondary btn-delete">Refuser</a>
                    </td>
                </tr>
                <!-- AVIS EXEMPLE 2 -->
                <tr>
                    <td>#AV-447</td>
                    <td>Julien R.</td>
                    <td>Menu Saveurs du Monde</td>
                    <td>⭐⭐⭐⭐</td>
                    <td>“Très bon mais un peu trop épicé.”</td>
                    <td>12/12/2024</td>
                    <td><span class="status valide">Validé</span></td>
                    <td>
                        <a href="#" class="btn-secondary btn-delete">Refuser</a>
                    </td>
                </tr>
                <!-- AVIS EXEMPLE 3 -->
                <tr>
                    <td>#AV-430</td>
                    <td>Sophie L.</td>
                    <td>Menu Cocktail Premium</td>
                    <td>⭐⭐⭐⭐⭐</td>
                    <td>“Excellent, je recommande !”</td>
                    <td>05/12/2024</td>
                    <td><span class="status refuse">Refusé</span></td>
                    <td>
                        <a href="#" class="btn-commande">Valider</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
