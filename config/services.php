<?php

require_once __DIR__ . '/database.php';

require_once __DIR__ . '/../repositories/sql/menuRepository.php';
require_once __DIR__ . '/../repositories/sql/commandeRepository.php';
require_once __DIR__ . '/../repositories/sql/avisRepository.php';
require_once __DIR__ . '/../repositories/sql/utilisateurRepository.php';

require_once __DIR__ . '/../services/commandeService.php';
require_once __DIR__ . '/../services/avisService.php';

/* ========== Repositories ========== */

$menuRepository = new MenuRepository($pdo);
$commandeRepository = new CommandeRepository($pdo);
$avisRepository = new AvisRepository($pdo);
$utilisateurRepository = new UtilisateurRepository($pdo);

/* ========== Services ========== */

$commandeService = new CommandeService(
    $pdo,
    $commandeRepository,
    $menuRepository
);

$avisService = new AvisService(
    $pdo,
    $avisRepository,
    $commandeRepository
);