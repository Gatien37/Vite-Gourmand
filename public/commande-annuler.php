<?php

/* ========== Initialisation de la session ========== */

session_start();

/* ========== Chargement des dépendances ========== */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

/* ========== Vérification utilisateur connecté ========== */

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

/* ========== Sécurisation de la méthode HTTP ========== */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: commande-utilisateur.php');
    exit;
}

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

/* ========== Règle métier : annulation autorisée uniquement si en attente ========== */

if ($commande['statut'] !== 'en_attente') {
    $_SESSION['error'] = "Impossible d'annuler : commande déjà traitée.";
    header('Location: commande-utilisateur.php');
    exit;
}

/* ========== Traitement de l'annulation ========== */

try {
    $pdo->beginTransaction();

    // Mise à jour du statut de la commande
    $stmtUpdate = $pdo->prepare("
        UPDATE commande
        SET statut = 'annulee'
        WHERE id = :id
    ");
    $stmtUpdate->execute(['id' => $commandeId]);

    // Ajout dans l'historique de suivi
    $stmtSuivi = $pdo->prepare("
        INSERT INTO commande_suivi (commande_id, statut)
        VALUES (:commande_id, 'annulee')
    ");
    $stmtSuivi->execute(['commande_id' => $commandeId]);

    // Restitution du stock du menu
    $stmtStock = $pdo->prepare("
        UPDATE menu
        SET stock = stock + :nb
        WHERE id = :menu_id
    ");
    $stmtStock->execute([
        'nb'      => (int) $commande['nb_personnes'],
        'menu_id'=> (int) $commande['menu_id']
    ]);

    $pdo->commit();

    $_SESSION['success'] = "Commande annulée avec succès.";

} catch (Exception $e) {

    $pdo->rollBack();
    $_SESSION['error'] = "Erreur lors de l'annulation de la commande.";
}

/* ========== Redirection finale ========== */

header('Location: commande-utilisateur.php');
exit;
