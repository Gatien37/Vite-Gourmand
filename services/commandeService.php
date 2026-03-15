<?php
/* ========== Dépendances ========== */

require_once __DIR__ . '/livraisonService.php';
require_once __DIR__ . '/../repositories/sql/commandeRepository.php';
require_once __DIR__ . '/../repositories/sql/menuRepository.php';

/* ========== Création d’une commande utilisateur ========== */

function traiterCommande($pdo, $menu, $post, $user)
{
    require_once __DIR__ . '/../config/commandeStatus.php';

    try {
        $pdo->beginTransaction();

        $statut = STATUT_EN_ATTENTE;

        $nb        = (int) ($post['nb_personnes'] ?? 0);
        $date      = $post['date'] ?? null;
        $heure     = $post['heure'] ?? null;
        $reception = $post['reception'] ?? null;

        $adresse = trim($post['adresse'] ?? '');
        $ville   = trim($post['ville'] ?? '');
        $cp      = trim($post['code_postal'] ?? '');

        if ($nb < $menu['nb_personnes_min'] || !$date || !$heure || !$reception) {
            return ['error' => 'Champs obligatoires manquants'];
        }

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

        if ($menu['stock'] < $nb) {
            return ['error' => 'Stock insuffisant pour ce menu'];
        }

        $prixMenu = $nb * $menu['prix_base'];
        $reduction = ($nb >= $menu['nb_personnes_min'] + 5)
            ? $prixMenu * 0.10
            : 0;

        $fraisLivraison = calculerFraisLivraison(
            $reception,
            $adresse,
            $ville,
            $cp
        );

        $total = $prixMenu - $reduction + $fraisLivraison;

        $commandeId = insertCommande($pdo, [
            'utilisateur_id' => $user['id'],
            'menu_id' => $menu['id'],
            'date_prestation' => "$date $heure",
            'adresse' => $reception === 'livraison' ? $adresse : 'Retrait sur place',
            'ville' => $reception === 'livraison' ? $ville : 'Bordeaux',
            'nb_personnes' => $nb,
            'prix_total' => $total,
            'statut' => $statut
        ]);

        insertCommandeSuiviRepository($pdo, (int) $commandeId, $statut);

        ajusterStockMenu($pdo, (int) $menu['id'], $nb);

        $pdo->commit();

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
        $pdo->rollBack();

        return ['error' => 'Erreur lors de la création de la commande'];
    }
}

/* ========== Modification d’une commande par l’utilisateur ========== */

function modifierCommandeUtilisateur(PDO $pdo, array $commande, array $post): ?string
{
    require_once __DIR__ . '/../config/commandeStatus.php';

    $date  = $post['date'] ?? '';
    $heure = $post['heure'] ?? '';
    $nb    = (int) ($post['nb_personnes'] ?? 0);

    $mode    = $post['reception'] ?? 'retrait';
    $adresse = trim($post['adresse'] ?? '');
    $ville   = trim($post['ville'] ?? '');
    $cp      = trim($post['code_postal'] ?? '');

    if (!$date || !$heure || $nb <= 0) {
        return "Veuillez remplir la date, l'heure et le nombre de personnes.";
    }

    if ($nb < (int) $commande['nb_personnes_min']) {
        return "Le minimum pour ce menu est {$commande['nb_personnes_min']} personnes.";
    }

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

    $ancienneQte = (int) ($commande['quantite'] ?? $commande['nb_personnes'] ?? 0);
    $delta       = $nb - $ancienneQte;

    if ($delta > 0 && (int) $commande['stock'] < $delta) {
        return "Stock insuffisant pour augmenter cette commande.";
    }

    try {
        $pdo->beginTransaction();

        if ($delta !== 0) {
            ajusterStockMenu($pdo, (int) $commande['menu_id'], $delta);
        }

        $total           = $nb * (float) $commande['prix_base'];
        $date_prestation = "$date $heure";

        updateCommandeRepository($pdo, (int) $commande['id'], [
            'date_prestation' => $date_prestation,
            'adresse'         => $mode === 'livraison' ? $adresse : 'Retrait sur place',
            'ville'           => $mode === 'livraison' ? $ville : 'Bordeaux',
            'nb_personnes'    => $nb,
            'prix_total'      => $total
        ]);

        insertCommandeSuiviRepository(
            $pdo,
            (int) $commande['id'],
            STATUT_EN_ATTENTE
        );

        $pdo->commit();

        return null;

    } catch (Exception $e) {
        $pdo->rollBack();

        return "Erreur lors de la modification.";
    }
}