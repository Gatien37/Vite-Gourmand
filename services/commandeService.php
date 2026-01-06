<?php
require_once __DIR__ . '/livraisonService.php';

function traiterCommande($pdo, $menu, $post, $user)
{
    require_once __DIR__ . '/../config/commandeStatus.php';

    try {
        $pdo->beginTransaction();

        $statut = STATUT_EN_ATTENTE;

        $nb = (int) ($post['nb_personnes'] ?? 0);
        $date = $post['date'] ?? null;
        $heure = $post['heure'] ?? null;
        $reception = $post['reception'] ?? null;

        $adresse = trim($post['adresse'] ?? '');
        $ville = trim($post['ville'] ?? '');
        $cp = trim($post['code_postal'] ?? '');

        if ($nb < $menu['nb_personnes_min'] || !$date || !$heure || !$reception) {
            return ['error' => 'Champs obligatoires manquants'];
        }

        if ($reception === 'livraison' && (!$adresse || !$ville || !preg_match('/^\d{5}$/', $cp))) {
            return ['error' => 'Adresse de livraison invalide'];
        }

        if ($menu['stock'] < $nb) {
            return ['error' => 'Stock insuffisant pour ce menu'];
        }

        $prixMenu = $nb * $menu['prix_base'];
        $reduction = ($nb >= $menu['nb_personnes_min'] + 5) ? $prixMenu * 0.10 : 0;
        $fraisLivraison = calculerFraisLivraison($reception, $adresse, $ville, $cp);
        $total = $prixMenu - $reduction + $fraisLivraison;

        // INSERT commande
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
            $reception === 'livraison' ? $ville : 'Bordeaux',
            $nb,
            $total,
            $statut
        ]);

        $commandeId = $pdo->lastInsertId();

        // INSERT suivi
        $stmtSuivi = $pdo->prepare("
            INSERT INTO commande_suivi (commande_id, statut)
            VALUES (?, ?)
        ");
        $stmtSuivi->execute([$commandeId, $statut]);

        // UPDATE stock
        $stmtStock = $pdo->prepare("
            UPDATE menu
            SET stock = stock - :nb
            WHERE id = :menu_id
        ");
        $stmtStock->execute([
            'nb' => $nb,
            'menu_id' => $menu['id']
        ]);

        $pdo->commit();

        return [
            'error' => null,
            'commande_id' => $commandeId,
            'recap' => [
                'menu' => $menu['nom'],
                'total' => $total,
                'date' => $date,
                'heure' => $heure,
                'nb' => $nb,
                'reception' => $reception
            ]
        ];

    } catch (Exception $e) {
        $pdo->rollBack();
        return ['error' => 'Erreur lors de la création de la commande'];
    }
}
