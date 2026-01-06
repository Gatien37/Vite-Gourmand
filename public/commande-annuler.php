<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: commande-utilisateur.php');
    exit;
}

$commandeId = (int)($_POST['commande_id'] ?? 0);
$userId = (int)$_SESSION['user']['id'];

$commande = getCommandeById($pdo, $commandeId);

// sécurité
if (!$commande || (int)$commande['utilisateur_id'] !== $userId) {
    header('Location: commande-utilisateur.php');
    exit;
}

// annulation autorisée uniquement si en attente
if ($commande['statut'] !== 'en_attente') {
    $_SESSION['error'] = "Impossible d’annuler : commande déjà traitée.";
    header('Location: commande-utilisateur.php');
    exit;
}

try {
    $pdo->beginTransaction();

    // 1) Mettre la commande en "annulee" (au lieu de DELETE)
    $stmtUpdate = $pdo->prepare("
        UPDATE commande
        SET statut = 'annulee'
        WHERE id = :id
    ");
    $stmtUpdate->execute(['id' => $commandeId]);

    // 2) Ajouter dans l'historique de suivi
    $stmtSuivi = $pdo->prepare("
        INSERT INTO commande_suivi (commande_id, statut)
        VALUES (:commande_id, 'annulee')
    ");
    $stmtSuivi->execute(['commande_id' => $commandeId]);

    // 3) Restitution du stock
    $stmtStock = $pdo->prepare("
        UPDATE menu
        SET stock = stock + :nb
        WHERE id = :menu_id
    ");
    $stmtStock->execute([
        'nb' => (int)$commande['nb_personnes'],
        'menu_id' => (int)$commande['menu_id']
    ]);

    $pdo->commit();

    $_SESSION['success'] = "Commande annulée avec succès.";

} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['error'] = "Erreur lors de l’annulation de la commande.";
}

header('Location: commande-utilisateur.php');
exit;
