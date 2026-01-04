<?php
require_once __DIR__ . '/livraisonService.php';

function traiterCommande($pdo, $menu, $post, $user) {

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

    $prixMenu = $nb * $menu['prix_base'];
    $reduction = ($nb >= $menu['nb_personnes_min'] + 5) ? $prixMenu * 0.10 : 0;
    $fraisLivraison = calculerFraisLivraison($reception, $adresse, $ville, $cp);
    $total = $prixMenu - $reduction + $fraisLivraison;

    $stmt = $pdo->prepare("
        INSERT INTO commande (utilisateur_id, menu_id, date_prestation, adresse, ville, nb_personnes, prix_total)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $user['id'],
        $menu['id'],
        "$date $heure",
        $reception === 'livraison' ? $adresse : 'Retrait sur place',
        $reception === 'livraison' ? $ville : 'Bordeaux',
        $nb,
        $total
    ]);

    $commandeId = $pdo->lastInsertId();


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
}
