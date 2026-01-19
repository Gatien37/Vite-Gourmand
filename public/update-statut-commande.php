<?php
/* ========== Chargement des middlewares et dépendances ========== */

require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';
require_once __DIR__ . '/../services/mailService.php';

/* ========== Réponse JSON ========== */

header('Content-Type: application/json');

/* ========== Lecture et validation des données JSON ========== */

$data = json_decode(file_get_contents('php://input'), true);

if (
    !isset($data['commande_id'], $data['statut']) ||
    !is_numeric($data['commande_id'])
) {
    http_response_code(400);
    echo json_encode(['error' => 'Données invalides']);
    exit;
}

$commandeId = (int) $data['commande_id'];
$statut     = $data['statut'];

/* ========== Validation du statut demandé ========== */

$statutsAutorises = [
    'en_attente',
    'acceptee',
    'en_preparation',
    'en_livraison',
    'livree',
    'attente_retour_materiel',
    'terminee'
];

if (!in_array($statut, $statutsAutorises, true)) {
    http_response_code(400);
    echo json_encode(['error' => 'Statut non autorisé']);
    exit;
}

/* ========== Fonction utilitaire : ajout de jours ouvrés ========== */

function ajouterJoursOuvres(DateTime $date, int $jours): DateTime
{
    $date    = clone $date;
    $ajoutes = 0;

    while ($ajoutes < $jours) {
        $date->modify('+1 day');

        /* 1 = lundi, 5 = vendredi */
        if ($date->format('N') < 6) {
            $ajoutes++;
        }
    }

    return $date;
}

/* ========== Traitement transactionnel du changement de statut ========== */

try {
    $pdo->beginTransaction();

    /* ===== Cas spécifique : prêt de matériel ===== */
    if ($statut === 'attente_retour_materiel') {

        $dateLimite = ajouterJoursOuvres(new DateTime(), 10);

        $stmt = $pdo->prepare("
            UPDATE commande
            SET
                pret_materiel = 1,
                date_limite_retour = :date_limite,
                statut = :statut
            WHERE id = :id
        ");

        $stmt->execute([
            'date_limite' => $dateLimite->format('Y-m-d'),
            'statut'      => $statut,
            'id'          => $commandeId
        ]);

        /* Suivi de commande */
        insertCommandeSuivi($pdo, $commandeId, $statut);

        /* Envoi de l’e-mail de notification */
        $commande = getCommandeById($pdo, $commandeId);

        envoyerMailPretMateriel(
            $commande['email'],
            $commande['menu_nom'],
            $dateLimite->format('d/m/Y')
        );

    }
    /* ===== Cas général : changement de statut simple ===== */
    else {

        $stmt = $pdo->prepare("
            UPDATE commande
            SET statut = :statut
            WHERE id = :id
        ");

        $stmt->execute([
            'statut' => $statut,
            'id'     => $commandeId
        ]);

        insertCommandeSuivi($pdo, $commandeId, $statut);
    }

    $pdo->commit();

    echo json_encode(['success' => true]);

} catch (Exception $e) {

    $pdo->rollBack();

    http_response_code(500);
    echo json_encode(['error' => 'Erreur serveur']);
}
