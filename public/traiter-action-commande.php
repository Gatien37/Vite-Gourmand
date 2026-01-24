<?php
/* ========== Sécurité : accès employé ou administrateur ========== */
require_once __DIR__ . '/../middlewares/requireEmploye.php';

/* ========== Sécurité CSRF ========== */
if (
    empty($_POST['csrf_token']) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    http_response_code(403);
    exit('Action non autorisée (CSRF).');
}

/* ========== Sécurité : méthode HTTP ========== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: gestion-commandes.php');
    exit;
}

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

/* ================== VALIDATION ================== */
if (
    empty($_POST['commande_id']) ||
    empty($_POST['contact_mode']) ||
    empty($_POST['motif']) ||
    empty($_POST['action'])
) {
    header('Location: gestion-commandes.php?error=action_incomplete');
    exit;
}

$commandeId  = (int) $_POST['commande_id'];
$contactMode = $_POST['contact_mode'];
$motif       = trim($_POST['motif']);
$action      = $_POST['action'];

/* ================== RECUP COMMANDE ================== */
$commande = getCommandeById($pdo, $commandeId);

if (!$commande) {
    header('Location: gestion-commandes.php');
    exit;
}

/*
 * nb_personnes est exposé sous l’alias "quantite"
 */
$nbPersonnes = (int) ($commande['quantite'] ?? 0);
$menuId      = (int) $commande['menu_id'];

/* ================== TRANSACTION ================== */
try {
    $pdo->beginTransaction();

    /* ================== TRACE ACTION ================== */
    $stmt = $pdo->prepare("
        INSERT INTO commande_actions 
        (commande_id, employe_id, action, contact_mode, motif, created_at)
        VALUES (:commande_id, :employe_id, :action, :contact_mode, :motif, NOW())
    ");

    $stmt->execute([
        'commande_id'  => $commandeId,
        'employe_id'   => $_SESSION['user']['id'],
        'action'       => $action,
        'contact_mode' => $contactMode,
        'motif'        => $motif
    ]);

    /* ================== ACTION METIER ================== */
    if ($action === 'annuler' && $commande['statut'] !== 'annulee') {

        /* Restitution du stock */
        $stmtStock = $pdo->prepare("
            UPDATE menu
            SET stock = stock + :nb
            WHERE id = :menu_id
        ");
        $stmtStock->execute([
            'nb'       => $nbPersonnes,
            'menu_id' => $menuId
        ]);

        /* Mise à jour du statut */
        $stmtCmd = $pdo->prepare("
            UPDATE commande 
            SET statut = 'annulee'
            WHERE id = :id
        ");
        $stmtCmd->execute([
            'id' => $commandeId
        ]);

        $pdo->commit();

        header(
            'Location: commande-detail-employe.php?id=' . $commandeId . '&success=annulee'
        );
        exit;
    }

    if ($action === 'modifier') {

        $pdo->commit();

        header(
            'Location: modifier-commande-employe.php?id=' . $commandeId
        );
        exit;
    }

    $pdo->commit();

    header(
        'Location: commande-detail-employe.php?id=' . $commandeId
    );
    exit;

} catch (Exception $e) {

    $pdo->rollBack();

    header(
        'Location: commande-detail-employe.php?id=' . $commandeId . '&error=action'
    );
    exit;
}
