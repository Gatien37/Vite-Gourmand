<?php
/* ========== Chargement des middlewares et dépendances ========== */

require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/platModel.php';

/* ========== Récupération et validation des paramètres ========== */

$id     = (int) ($_GET['id'] ?? 0);
$action = $_GET['action'] ?? '';

if (
    !$id ||
    !in_array($action, ['desactiver', 'activer'], true)
) {
    header('Location: gestion-plats.php');
    exit;
}

/* ========== Détermination du statut d’activation ========== */

$actif = ($action === 'activer');

/* ========== Mise à jour du statut du plat ========== */

togglePlat($pdo, $id, $actif);

/* ========== Redirection vers la gestion des plats ========== */

header('Location: gestion-plats.php');
exit;
