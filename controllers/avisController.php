<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../repositories/sql/avisRepository.php';
require_once __DIR__ . '/../repositories/sql/commandeRepository.php';
require_once __DIR__ . '/../services/avisService.php';

/* ===== Initialisation des objets ===== */

$avisRepository = new AvisRepository($pdo);
$commandeRepository = new CommandeRepository($pdo);

$avisService = new AvisService(
    $pdo,
    $avisRepository,
    $commandeRepository
);

/* =====================================================
   Récupération des avis validés (site public)
   ===================================================== */

function handleGetAvisValides(AvisService $avisService, int $limit = 3): array
{
    return $avisService->getAvisValides($limit);
}

/* =====================================================
   Gestion des avis (admin)
   ===================================================== */

function handleGetAllAvis(AvisService $avisService): array
{
    return $avisService->getAllAvis();
}

/* =====================================================
   Validation / refus d’un avis
   ===================================================== */

function handleToggleAvis(AvisService $avisService, int $avisId, string $action): void
{
    $valide = ($action === 'valider');

    $avisService->setAvisValide($avisId, $valide);
}