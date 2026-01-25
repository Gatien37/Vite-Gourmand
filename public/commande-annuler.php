<?php

/* ========== Sécurisation : accès utilisateur ========== */
require_once __DIR__ . '/../middlewares/requireUtilisateur.php';

/* ========== Sécurisation de la méthode HTTP ========== */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Vérification CSRF ========== */
if (
    empty($_POST['csrf_token']) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    http_response_code(403);
    exit('Action non autorisée (CSRF).');
}

/* ========== Chargement des dépendances ========== */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

/* ========== Récupération des données ========== */
$commandeId = (int) ($_POST['commande_id'] ?? 0);
$userId     = (int) $_SESSION['user']['id'];

/* ========== Récupération de la commande ========== */
$commande = getCommandeById($pdo, $commandeId);

/* ========== Sécurité : propriété de la commande ========== */
if (!$commande || (int) $commande['utilisateur_id'] !== $userId) {
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Annulation autorisée uniquement si en attente ========== */
if ($commande['statut'] !== 'en_attente') {
    $_SESSION['error'] = "Impossible d'annuler : commande déjà traitée.";
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Traitement de l'annulation ========== */
try {
    $pdo->beginTransaction();

    /* Mise à jour du statut */
    $stmtUpdate = $pdo->prepare("
        UPDATE commande
        SET statut = 'annulee'
        WHERE id = :id
    ");
    $stmtUpdate->execute(['id' => $commandeId]);

    /* Historique */
    $stmtSuivi = $pdo->prepare("
        INSERT INTO commande_suivi (commande_id, statut)
        VALUES (:commande_id, 'annulee')
    ");
    $stmtSuivi->execute(['commande_id' => $commandeId]);

    /* Restitution du stock */
    $stmtStock = $pdo->prepare("
        UPDATE menu
        SET stock = stock + :nb
        WHERE id = :menu_id
    ");
    $stmtStock->execute([
        'nb'       => (int) $commande['nb_personnes'],
        'menu_id' => (int) $commande['menu_id']
    ]);

    $pdo->commit();

    $_SESSION['success'] = "Commande annulée avec succès.";

    /* Sécurité : invalider le token CSRF après succès */
    unset($_SESSION['csrf_token']);

} catch (Exception $e) {

    $pdo->rollBack();
    $_SESSION['error'] = "Erreur lors de l'annulation de la commande.";
}

/* ========== Redirection finale ========== */
header('Location: commande-utilisateur.php');
exit;
