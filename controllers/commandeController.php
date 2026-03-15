<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../services/commandeService.php';
require_once __DIR__ . '/../repositories/sql/commandeRepository.php';
require_once __DIR__ . '/../repositories/sql/menuRepository.php';
require_once __DIR__ . '/../repositories/sql/CommandeRepository.php';
require_once __DIR__ . '/../services/mailService.php';


function ajouterJoursOuvres(DateTime $date, int $jours): DateTime
{
    $date = clone $date;
    $ajoutes = 0;

    while ($ajoutes < $jours) {
        $date->modify('+1 day');
        if ($date->format('N') < 6) {
            $ajoutes++;
        }
    }

    return $date;
}


function handleUpdateStatutCommande(PDO $pdo): void
{
    header('Content-Type: application/json');

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

    try {
        $pdo->beginTransaction();

        if ($statut === 'attente_retour_materiel') {
            $dateLimite = ajouterJoursOuvres(new DateTime(), 10);

            updateCommandePretMaterielRepository(
                $pdo,
                $commandeId,
                $statut,
                $dateLimite->format('Y-m-d')
            );

            insertCommandeSuiviRepository($pdo, $commandeId, $statut);

            $commande = getCommandeById($pdo, $commandeId);

            envoyerMailPretMateriel(
                $commande['email'],
                $commande['menu_nom'],
                $dateLimite->format('d/m/Y')
            );
        } else {
            updateCommandeStatutRepository($pdo, $commandeId, $statut);
            insertCommandeSuiviRepository($pdo, $commandeId, $statut);
        }

        $pdo->commit();

        echo json_encode(['success' => true]);

    } catch (Exception $e) {
        $pdo->rollBack();

        http_response_code(500);
        echo json_encode(['error' => 'Erreur serveur']);
    }
}