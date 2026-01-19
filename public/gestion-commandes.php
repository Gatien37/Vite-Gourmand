<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

$statut = $_GET['statut'] ?? null;
$client = $_GET['client'] ?? null;

$commandes = getCommandesFiltrees($pdo, $statut, $client);
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Gestion des commandes";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>

    <section class="hero-section commandes-hero">
        <h1>Gestion des commandes</h1>
        <p>Consultez et mettez à jour les commandes clients.</p>
    </section>

    <section class="filtres">
        <form method="GET" class="ca-filter-form">

            <!-- Filtre statut -->
            <div>
                <label for="statut">Statut</label>
                <select name="statut" id="statut">
                    <option value="">Tous</option>
                    <option value="en_attente">En attente</option>
                    <option value="acceptee">Acceptée</option>
                    <option value="en_preparation">En préparation</option>
                    <option value="en_livraison">En livraison</option>
                    <option value="livree">Livrée</option>
                    <option value="terminee">Terminée</option>
                    <option value="attente_retour_materiel">En attente retour matériel</option>
                </select>
            </div>

            <!-- Filtre client -->
            <div>
                <label for="client">Client</label>
                <input
                    type="text"
                    name="client"
                    id="client"
                    placeholder="Nom ou email"
                    value="<?= htmlspecialchars($_GET['client'] ?? '') ?>"
                >
            </div>

            <button type="submit" class="btn-commande">Filtrer</button>

        </form>
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
                    <th>Statut</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td>#CMD-<?= htmlspecialchars($commande['id']) ?></td>
                        <td><?= htmlspecialchars($commande['client_nom']) ?></td>
                        <td><?= htmlspecialchars($commande['menu_nom']) ?></td>
                        <td><?= date('d/m/Y', strtotime($commande['date_prestation'])) ?></td>
                        <td><?= date('H:i', strtotime($commande['date_prestation'])) ?></td>

                        <td>
                        <?php if ($commande['statut'] === 'annulee'): ?>

                            <span class="status annulee">Annulée</span>

                        <?php else: ?>

                            <select class="select-statut" data-commande-id="<?= $commande['id'] ?>">
                                <option value="en_attente" <?= $commande['statut'] === 'en_attente' ? 'selected' : '' ?>>En attente</option>
                                <option value="acceptee" <?= $commande['statut'] === 'acceptee' ? 'selected' : '' ?>>Acceptée</option>
                                <option value="en_preparation" <?= $commande['statut'] === 'en_preparation' ? 'selected' : '' ?>>En préparation</option>
                                <option value="en_livraison" <?= $commande['statut'] === 'en_livraison' ? 'selected' : '' ?>>En cours de livraison</option>
                                <option value="livree" <?= $commande['statut'] === 'livree' ? 'selected' : '' ?>>Livrée</option>
                                <option value="attente_retour_materiel" <?= $commande['statut'] === 'attente_retour_materiel' ? 'selected' : '' ?>>En attente retour matériel</option>
                                <option value="terminee" <?= $commande['statut'] === 'terminee' ? 'selected' : '' ?>>Terminée</option>
                            </select>

                        <?php endif; ?>
                        </td>


                        <td><?= number_format($commande['prix_total'], 2, ',', ' ') ?> €</td>
                        <td>
                            <a href="commande-detail-employe.php?id=<?= $commande['id'] ?>" class="btn-commande">Détails</a>
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
