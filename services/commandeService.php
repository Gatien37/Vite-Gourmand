<?php
/* ========== Dépendances ========== */

require_once __DIR__ . '/livraisonService.php';

/* ========== Création d’une commande utilisateur ========== */

function traiterCommande($pdo, $menu, $post, $user)
{
    /* ========== Chargement des statuts ========== */
    require_once __DIR__ . '/../config/commandeStatus.php';

    try {
        /* ========== Démarrage transaction ========== */
        $pdo->beginTransaction();

        $statut = STATUT_EN_ATTENTE;

        /* ========== Récupération des données du formulaire ========== */

        $nb        = (int) ($post['nb_personnes'] ?? 0);
        $date      = $post['date'] ?? null;
        $heure     = $post['heure'] ?? null;
        $reception = $post['reception'] ?? null;

        $adresse = trim($post['adresse'] ?? '');
        $ville   = trim($post['ville'] ?? '');
        $cp      = trim($post['code_postal'] ?? '');

        /* ========== Validation des champs obligatoires ========== */

        if ($nb < $menu['nb_personnes_min'] || !$date || !$heure || !$reception) {
            return ['error' => 'Champs obligatoires manquants'];
        }

        /* ========== Validation de l’adresse de livraison ========== */

        if (
            $reception === 'livraison' &&
            (
                !$adresse ||
                !$ville ||
                !preg_match('/^\d{5}$/', $cp)
            )
        ) {
            return ['error' => 'Adresse de livraison invalide'];
        }

        /* ========== Vérification du stock disponible ========== */

        if ($menu['stock'] < $nb) {
            return ['error' => 'Stock insuffisant pour ce menu'];
        }

        /* ========== Calcul du prix ========== */

        $prixMenu      = $nb * $menu['prix_base'];
        $reduction     = ($nb >= $menu['nb_personnes_min'] + 5)
            ? $prixMenu * 0.10
            : 0;
        $fraisLivraison = calculerFraisLivraison(
            $reception,
            $adresse,
            $ville,
            $cp
        );
        $total = $prixMenu - $reduction + $fraisLivraison;

        /* ========== Insertion de la commande ========== */

        $stmt = $pdo->prepare("
            INSERT INTO commande
            (utilisateur_id, menu_id, date_prestation, adresse, ville, nb_personnes, prix_total, statut)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $user['id'],
            $menu['id'],
            "$date $heure",
            $reception === 'livraison' ? $adresse : 'Retrait sur place',
            $reception === 'livraison' ? $ville   : 'Bordeaux',
            $nb,
            $total,
            $statut
        ]);

        $commandeId = $pdo->lastInsertId();

        /* ========== Insertion du suivi de commande ========== */

        $stmtSuivi = $pdo->prepare("
            INSERT INTO commande_suivi (commande_id, statut)
            VALUES (?, ?)
        ");
        $stmtSuivi->execute([$commandeId, $statut]);

        /* ========== Mise à jour du stock du menu ========== */

        $stmtStock = $pdo->prepare("
            UPDATE menu
            SET stock = stock - :nb
            WHERE id = :menu_id
        ");
        $stmtStock->execute([
            'nb'      => $nb,
            'menu_id'=> $menu['id']
        ]);

        /* ========== Validation transaction ========== */
        $pdo->commit();

        /* ========== Retour du récapitulatif ========== */

        return [
            'error'       => null,
            'commande_id' => $commandeId,
            'recap'       => [
                'menu'      => $menu['nom'],
                'total'     => $total,
                'date'      => $date,
                'heure'     => $heure,
                'nb'        => $nb,
                'reception' => $reception
            ]
        ];

    } catch (Exception $e) {

        /* ========== Annulation transaction ========== */
        $pdo->rollBack();

        return ['error' => 'Erreur lors de la création de la commande'];
    }
}

/* ========== Modification d’une commande par l’utilisateur ========== */

function modifierCommandeUtilisateur(PDO $pdo, array $commande, array $post): ?string
{
    /* ========== Chargement des statuts ========== */
    require_once __DIR__ . '/../config/commandeStatus.php';

    /* ========== Récupération des données ========== */

    $date  = $post['date']  ?? '';
    $heure = $post['heure'] ?? '';
    $nb    = (int) ($post['nb_personnes'] ?? 0);

    $mode    = $post['reception'] ?? 'retrait';
    $adresse = trim($post['adresse'] ?? '');
    $ville   = trim($post['ville'] ?? '');
    $cp      = trim($post['code_postal'] ?? '');

    /* ========== Validation des champs principaux ========== */

    if (!$date || !$heure || $nb <= 0) {
        return "Veuillez remplir la date, l'heure et le nombre de personnes.";
    }

    if ($nb < (int) $commande['nb_personnes_min']) {
        return "Le minimum pour ce menu est {$commande['nb_personnes_min']} personnes.";
    }

    /* ========== Validation livraison ========== */

    if (
        $mode === 'livraison' &&
        (
            !$adresse ||
            !$ville ||
            !preg_match('/^\d{5}$/', $cp)
        )
    ) {
        return "Adresse de livraison invalide.";
    }

    /* ========== Calcul de la variation de stock ========== */

    $ancienneQte = (int) $commande['nb_personnes'];
    $delta       = $nb - $ancienneQte;

    if ($delta > 0 && (int) $commande['stock'] < $delta) {
        return "Stock insuffisant pour augmenter cette commande.";
    }

    try {
        /* ========== Démarrage transaction ========== */
        $pdo->beginTransaction();

        /* ========== Ajustement du stock si nécessaire ========== */

        if ($delta !== 0) {
            $stmtStock = $pdo->prepare("
                UPDATE menu
                SET stock = stock - :delta
                WHERE id = :menu_id
            ");
            $stmtStock->execute([
                'delta'   => $delta,
                'menu_id'=> (int) $commande['menu_id']
            ]);
        }

        /* ========== Mise à jour de la commande ========== */

        $total            = $nb * (float) $commande['prix_base'];
        $date_prestation  = "$date $heure";

        updateCommande($pdo, (int) $commande['id'], [
            'date_prestation' => $date_prestation,
            'adresse'         => $mode === 'livraison' ? $adresse : 'Retrait sur place',
            'ville'           => $mode === 'livraison' ? $ville   : 'Bordeaux',
            'nb_personnes'    => $nb,
            'prix_total'      => $total
        ]);

        /* ========== Historique : retour en attente ========== */

        insertCommandeSuivi(
            $pdo,
            (int) $commande['id'],
            STATUT_EN_ATTENTE
        );

        /* ========== Validation transaction ========== */
        $pdo->commit();

        return null;

    } catch (Exception $e) {

        /* ========== Annulation transaction ========== */
        $pdo->rollBack();

        return "Erreur lors de la modification.";
    }
}
