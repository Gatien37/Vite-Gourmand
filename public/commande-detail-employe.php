<?php
require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: gestion-commandes.php');
    exit;
}

$commandeId = (int) $_GET['id'];
$commande = getCommandeById($pdo, $commandeId);

if (!$commande) {
    header('Location: gestion-commandes.php');
    exit;
}

$date = new DateTime($commande['date_prestation']);

$motifAnnulation = null;
if ($commande['statut'] === 'annulee') {
    $motifAnnulation = getMotifAnnulation($pdo, $commandeId);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
    $title = "Détail commande employé";
    require_once __DIR__ . '/../partials/head.php';
    ?>
</head>
<body>

<?php require_once __DIR__ . '/../partials/header.php'; ?>

<section class="hero-section commandes-hero">
    <h1>Commande #CMD-<?= (int)$commande['id'] ?></h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert-success">
            L'action a bien été enregistrée.
        </div>
    <?php endif; ?>

    <p>Détail complet de la commande client</p>
</section>

<section class="order-detail-container">
    <div class="order-card">

        <h3>Informations client</h3>
        <p><strong>Nom :</strong> <?= htmlspecialchars($commande['client_nom']) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($commande['client_email']) ?></p>
        <p><strong>GSM :</strong> <?= htmlspecialchars($commande['client_gsm']) ?></p>

        <h3>Commande</h3>
        <p><strong>Menu :</strong> <?= htmlspecialchars($commande['menu_nom']) ?></p>
        <p><strong>Date prestation :</strong> <?= $date->format('d/m/Y') ?></p>
        <p><strong>Heure :</strong> <?= $date->format('H:i') ?></p>
        <p><strong>Nombre de personnes :</strong> <?= (int)$commande['quantite'] ?></p>

        <?php if (!empty($commande['adresse'])): ?>
            <h3>Adresse</h3>
            <p>
                <?= htmlspecialchars($commande['adresse']) ?><br>
                <?= htmlspecialchars($commande['ville']) ?>
            </p>
        <?php endif; ?>

        <h3>Statut</h3>
        <span class="status-en-cours">
            <?= ucfirst(str_replace('_', ' ', htmlspecialchars($commande['statut']))) ?>
        </span>

        <?php if ($commande['statut'] === 'annulee' && $motifAnnulation): ?>
            <div class="alert-annulation">
                <p><strong>Commande annulée</strong></p>

                <p>
                    <strong>Contact client :</strong>
                    <?= $motifAnnulation['contact_mode'] === 'gsm' ? 'Appel GSM' : 'Email' ?>
                </p>

                <p>
                    <strong>Motif :</strong><br>
                    <?= nl2br(htmlspecialchars($motifAnnulation['motif'])) ?>
                </p>

                <p class="annulation-date">
                    Annulée le <?= date('d/m/Y à H:i', strtotime($motifAnnulation['created_at'])) ?>
                </p>
            </div>
        <?php endif; ?>

        <h3>Total</h3>
        <p><strong><?= number_format($commande['prix_total'], 2, ',', ' ') ?> €</strong></p>

        <div class="order-actions">

            <?php if ($commande['statut'] !== 'annulee'): ?>

                <h3>Action sur la commande</h3>

                <form method="POST" action="traiter-action-commande.php" class="form-card">

                    <input type="hidden" name="commande_id" value="<?= (int)$commande['id'] ?>">

                    <label for="contact_mode"><strong>Contact client effectué via *</strong></label>
                    <select name="contact_mode" id="contact_mode" required>
                        <option value="">-- Choisir --</option>
                        <option value="gsm">Appel GSM</option>
                        <option value="email">Email</option>
                    </select>

                    <label for="motif"><strong>Motif *</strong></label>
                    <textarea
                        name="motif"
                        id="motif"
                        rows="4"
                        required
                        placeholder="Ex : Client injoignable / Demande d'annulation / Changement de date..."
                    ></textarea>

                    <label for="action"><strong>Action *</strong></label>
                    <select name="action" id="action" required>
                        <option value="">-- Choisir --</option>
                        <option value="modifier">Modifier la commande</option>
                        <option value="annuler">Annuler la commande</option>
                    </select>

                    <button type="submit" class="btn-commande">
                        Valider l'action
                    </button>
                </form>

            <?php endif; ?>

            <a href="gestion-commandes.php" class="btn-secondary">
                ← Retour à la gestion des commandes
            </a>

        </div>

    </div>
</section>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>

</body>
</html>
