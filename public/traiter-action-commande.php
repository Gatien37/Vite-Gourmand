<?php

require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';

if (
    empty($_POST['commande_id']) ||
    empty($_POST['contact_mode']) ||
    empty($_POST['motif']) ||
    empty($_POST['action'])
) {
    header('Location: gestion-commandes.php?error=action_incomplete');
    exit;
}

$commandeId   = (int) $_POST['commande_id'];
$contactMode  = $_POST['contact_mode'];
$motif        = trim($_POST['motif']);
$action       = $_POST['action'];

$sql = "
    INSERT INTO commande_actions 
    (commande_id, employe_id, action, contact_mode, motif, created_at)
    VALUES (:commande_id, :employe_id, :action, :contact_mode, :motif, NOW())
";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'commande_id' => $commandeId,
    'employe_id'  => $_SESSION['user']['id'],
    'action'      => $action,
    'contact_mode'=> $contactMode,
    'motif'       => $motif
]);

if ($action === 'annuler') {
    $pdo->prepare("UPDATE commande SET statut = 'annulee' WHERE id = ?")
        ->execute([$commandeId]);
}

header(
  'Location: commande-detail-employe.php?id=' . $commandeId . '&success=1'
);
exit;
