<?php
/* ========== Chargement des middlewares et dépendances ========== */

require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/avisModel.php';

/* ========== Récupération et validation des paramètres ========== */

$id     = (int) ($_GET['id'] ?? 0);
$action = $_GET['action'] ?? '';

if (
    !$id ||
    !in_array($action, ['valider', 'refuser'], true)
) {
    header('Location: gestion-avis.php');
    exit;
}

/* ========== Détermination du statut de validation ========== */

$valide = ($action === 'valider');

/* ========== Mise à jour de l’avis ========== */

setAvisValide($pdo, $id, $valide);

/* ========== Redirection vers la gestion des avis ========== */

header('Location: gestion-avis.php');
exit;
