<?php

require_once __DIR__ . '/../../middlewares/requireAdmin.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/mongo.php';

use MongoDB\BSON\UTCDateTime;

/* ========= Sécurisation MongoDB ========= */
if (!$menuStatsCollection) {
    header('Location: /statistiques.php?error=mongodb');
    exit;
}

/* ========= Sécurisation de la redirection ========= */
$allowedPages = ['statistiques', 'chiffre-affaire'];
$redirect = $_GET['redirect'] ?? 'statistiques';

if (!in_array($redirect, $allowedPages, true)) {
    $redirect = 'statistiques';
}

/* ========= Nettoyage MongoDB ========= */
$menuStatsCollection->deleteMany([]);

/* ========= Recalcul depuis MySQL ========= */
$sql = "
    SELECT
        m.id AS menu_id,
        m.nom AS menu_nom,
        DATE(c.date_prestation) AS jour,
        COUNT(c.id) AS nb_commandes,
        SUM(c.prix_total) AS chiffre_affaires
    FROM commande c
    INNER JOIN menu m ON c.menu_id = m.id
    WHERE c.statut = 'terminee'
    GROUP BY m.id, jour
";

$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ========= Insertion MongoDB ========= */
foreach ($rows as $row) {
    $menuStatsCollection->insertOne([
        'menu_id' => (int) $row['menu_id'],
        'menu_nom' => $row['menu_nom'],
        'jour' => $row['jour'],
        'nb_commandes' => (int) $row['nb_commandes'],
        'chiffre_affaires' => (float) $row['chiffre_affaires'],
        'createdAt' => new UTCDateTime()
    ]);
}

/* ========= Redirection ========= */
header("Location: /{$redirect}.php?sync=success");
exit;
