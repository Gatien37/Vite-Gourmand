<?php

require_once __DIR__ . '/../middlewares/requireEmploye.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/commandeModel.php';

/* ================== VALIDATION POST ================== */

if (
    empty($_POST['commande_id']) ||
    empty($_POST['date']) ||
    empty($_POST['heure']) ||
    empty($_POST['quantite'])
) {
    header('Location: gestion-commandes.php?error=modification_incomplete');
    exit;
}

$commandeId = (int) $_POST['commande_id'];
$date       = $_POST['date'];
$heure      = $_POST['heure'];
$newNb      = (int) $_POST['quantite'];
$adresse    = trim($_POST['adresse'] ?? '');
$ville      = trim($_POST['ville'] ?? '');

/* ================== RECUP COMMANDE ================== */

$commande = getCommandeById($pdo, $commandeId);

if (!$commande || $commande['statut'] === 'annulee') {
    header('Location: gestion-commandes.php');
    exit;
}

/*
 * IMPORTANT :
 * getCommandeById retourne nb_personnes sous l’alias "quantite"
 */
$oldNb  = (int) ($commande['quantite'] ?? 0);
$menuId = (int) $commande['menu_id'];
$diff   = $newNb - $oldNb;

/* ================== TRANSACTION ================== */

try {
    $pdo->beginTransaction();

    /* ====== RECUP MENU (toujours, car prix recalculé) ====== */

    $stmtMenu = $pdo->prepare("
        SELECT stock, prix_base, nb_personnes_min
        FROM menu
        WHERE id = :menu_id
        FOR UPDATE
    ");
    $stmtMenu->execute(['menu_id' => $menuId]);
    $menu = $stmtMenu->fetch(PDO::FETCH_ASSOC);

    if (!$menu) {
        throw new Exception('Menu introuvable');
    }

    /* ====== AJUSTEMENT STOCK ====== */

    if ($diff !== 0) {

        // Si augmentation du nombre de personnes, on vérifie le stock
        if ($diff > 0 && (int)$menu['stock'] < $diff) {
            throw new Exception('Stock insuffisant pour augmenter le nombre de personnes');
        }

        // stock = stock - diff (si diff < 0, on rend du stock)
        $stmtStock = $pdo->prepare("
            UPDATE menu
            SET stock = stock - :diff
            WHERE id = :menu_id
        ");
        $stmtStock->execute([
            'diff'    => $diff,
            'menu_id' => $menuId
        ]);
    }

    /* ================== RECALCUL PRIX ================== */

    $prixBase = (float) $menu['prix_base'];
    $nbMin    = (int) $menu['nb_personnes_min'];

    $prixMenu  = $newNb * $prixBase;
    $reduction = ($newNb >= $nbMin + 5) ? $prixMenu * 0.10 : 0;
    $prixTotal = $prixMenu - $reduction;

    /* ================== UPDATE COMMANDE ================== */

    $stmtCmd = $pdo->prepare("
        UPDATE commande
        SET 
            date_prestation = :date_prestation,
            nb_personnes = :nb,
            prix_total = :prix_total,
            adresse = :adresse,
            ville = :ville
        WHERE id = :id
    ");

    $stmtCmd->execute([
        'date_prestation' => "$date $heure",
        'nb'              => $newNb,
        'prix_total'      => $prixTotal,
        'adresse'         => $adresse,
        'ville'           => $ville,
        'id'              => $commandeId
    ]);

    $pdo->commit();

    header('Location: commande-detail-employe.php?id=' . $commandeId . '&success=modifiee');
    exit;

} catch (Exception $e) {

    $pdo->rollBack();

    header('Location: commande-detail-employe.php?id=' . $commandeId . '&error=stock');
    exit;
}
