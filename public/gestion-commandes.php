<?php
/* ========== Sécurité : accès employé ou administrateur ========== */
require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';
require_once __DIR__ . '/../services/mailService.php';

/* ========== Génération du token CSRF ========== */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ========== Traitement mise à jour statut (POST) ========== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ===== Vérification CSRF ===== */
    if (
        empty($_POST['csrf_token']) ||
        empty($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die('Action non autorisée.');
    }

    $commandeId = isset($_POST['commande_id']) ? (int) $_POST['commande_id'] : 0;
    $newStatut  = $_POST['statut'] ?? '';

    if ($commandeId > 0 && $newStatut !== '') {

        /* ===== Récupération statut actuel ===== */
        $commandeAvant = getCommandeById($pdo, $commandeId);

        updateStatutCommande($pdo, $commandeId, $newStatut);

        /* ===== Envoi mails conditionnels ===== */
        if ($commandeAvant && $commandeAvant['statut'] !== $newStatut) {

            /* Récupération commande à jour */
            $commande = getCommandeById($pdo, $commandeId);

            if ($commande) {

                /* ===== Commande terminée → demande d’avis ===== */
                if ($newStatut === 'terminee') {
                    envoyerMailCommandeTerminee(
                        $commande['email_client'],
                        $commande['menu_nom']
                    );
                }

                /* ===== Attente retour matériel ===== */
                if ($newStatut === 'attente_retour_materiel') {
                    envoyerMailPretMateriel(
                        $commande['email_client'],
                        $commande['menu_nom'],
                        $commande['date_limite_retour']
                    );
                }
            }
        }
    }

    /* ===== Conserver les filtres ===== */
    $qs = http_build_query([
        'statut' => $_GET['statut'] ?? '',
        'client' => $_GET['client'] ?? '',
    ]);

    header('Location: gestion-commandes.php' . ($qs ? ('?' . $qs) : ''));
    exit;
}

/* ========== Récupération des filtres ========== */
$statut = $_GET['statut'] ?? '';
$client = $_GET['client'] ?? '';

/* ========== Récupération des commandes filtrées ========== */
$commandes = getCommandesFiltrees($pdo, $statut ?: null, $client ?: null);
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

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main id="main-content">

    <section class="hero-section commandes-hero">
        <h1>Gestion des commandes</h1>
        <p>Consultez et mettez à jour les commandes clients.</p>
    </section>

    <!-- ===== Filtres ===== -->
    <section class="filtres">
        <form method="GET" class="ca-filter-form">

            <div>
                <label for="statut">Statut</label>
                <select name="statut" id="statut">
                    <option value="" <?= $statut === '' ? 'selected' : '' ?>>Tous</option>
                    <option value="en_attente" <?= $statut === 'en_attente' ? 'selected' : '' ?>>En attente</option>
                    <option value="acceptee" <?= $statut === 'acceptee' ? 'selected' : '' ?>>Acceptée</option>
                    <option value="en_preparation" <?= $statut === 'en_preparation' ? 'selected' : '' ?>>En préparation</option>
                    <option value="en_livraison" <?= $statut === 'en_livraison' ? 'selected' : '' ?>>En livraison</option>
                    <option value="livree" <?= $statut === 'livree' ? 'selected' : '' ?>>Livrée</option>
                    <option value="attente_retour_materiel" <?= $statut === 'attente_retour_materiel' ? 'selected' : '' ?>>
                        En attente retour matériel
                    </option>
                    <option value="terminee" <?= $statut === 'terminee' ? 'selected' : '' ?>>Terminée</option>
                </select>
            </div>

            <div>
                <label for="client">Client</label>
                <input
                    type="text"
                    name="client"
                    id="client"
                    placeholder="Nom ou email"
                    value="<?= htmlspecialchars($client) ?>"
                >
            </div>

            <button type="submit" class="btn-commande">
                Filtrer
            </button>

        </form>
    </section>

    <!-- ===== Tableau des commandes ===== -->
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

                        <td>#CMD-<?= (int) $commande['id'] ?></td>
                        <td><?= htmlspecialchars($commande['client_nom']) ?></td>
                        <td><?= htmlspecialchars($commande['menu_nom']) ?></td>
                        <td><?= date('d/m/Y', strtotime($commande['date_prestation'])) ?></td>
                        <td><?= date('H:i', strtotime($commande['date_prestation'])) ?></td>

                        <td>
                            <?php if ($commande['statut'] === 'annulee'): ?>
                                <span class="status annulee">Annulée</span>
                            <?php else: ?>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                    <input type="hidden" name="commande_id" value="<?= (int) $commande['id'] ?>">

                                    <select name="statut" class="select-statut" onchange="this.form.submit()">
                                        <option value="en_attente" <?= $commande['statut'] === 'en_attente' ? 'selected' : '' ?>>En attente</option>
                                        <option value="acceptee" <?= $commande['statut'] === 'acceptee' ? 'selected' : '' ?>>Acceptée</option>
                                        <option value="en_preparation" <?= $commande['statut'] === 'en_preparation' ? 'selected' : '' ?>>En préparation</option>
                                        <option value="en_livraison" <?= $commande['statut'] === 'en_livraison' ? 'selected' : '' ?>>En livraison</option>
                                        <option value="livree" <?= $commande['statut'] === 'livree' ? 'selected' : '' ?>>Livrée</option>
                                        <option value="attente_retour_materiel" <?= $commande['statut'] === 'attente_retour_materiel' ? 'selected' : '' ?>>
                                            En attente retour matériel
                                        </option>
                                        <option value="terminee" <?= $commande['statut'] === 'terminee' ? 'selected' : '' ?>>Terminée</option>
                                    </select>
                                </form>
                            <?php endif; ?>
                        </td>

                        <td><?= number_format((float) $commande['prix_total'], 2, ',', ' ') ?> €</td>

                        <td>
                            <a
                                href="commande-detail-employe.php?id=<?= (int) $commande['id'] ?>"
                                class="btn-commande"
                            >
                                Détails
                            </a>
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
