<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../repositories/sql/avisRepository.php';


/* =====================================================
   Récupération des avis validés (site public)
   ===================================================== */

function handleGetAvisValides(int $limit = 3): array
{
    global $pdo;

    return getAvisValides($pdo, $limit);
}


/* =====================================================
   Gestion des avis (admin)
   ===================================================== */

function handleGetAllAvis(): array
{
    global $pdo;

    return getAllAvis($pdo);
}


/* =====================================================
   Validation / refus d’un avis
   ===================================================== */

function handleToggleAvis(int $avisId, string $action): void
{
    global $pdo;

    $valide = ($action === 'valider');

    setAvisValide($pdo, $avisId, $valide);
}