<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../repositories/sql/commandeRepository.php';
require_once __DIR__ . '/../services/CommandeService.php';
require_once __DIR__ . '/../services/mailService.php';

$commandeRepository = new CommandeRepository($pdo);
$commandeService = new CommandeService($pdo, $commandeRepository);

function handleUpdateStatutCommande(PDO $pdo, CommandeService $commandeService, CommandeRepository $commandeRepository): void
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
    $statut = $data['statut'];

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

            $dateLimite = $commandeService->marquerCommeLivreeAvecPret($commandeId);

            $commande = $commandeRepository->getCommandeById($commandeId);

            if ($commande && !empty($commande['client_email'])) {

                envoyerMailPretMateriel(
                    $commande['client_email'],
                    $commande['menu_nom'],
                    date('d/m/Y', strtotime($dateLimite))
                );

            }

        } else {

            $commandeService->changerStatut($commandeId, $statut);

        }

        $pdo->commit();

        echo json_encode(['success' => true]);

    } catch (Exception $e) {

        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }

        http_response_code(500);
        echo json_encode(['error' => 'Erreur serveur']);

    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleUpdateStatutCommande($pdo, $commandeService, $commandeRepository);
}