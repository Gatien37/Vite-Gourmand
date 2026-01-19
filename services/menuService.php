<?php
/* ========== Création / modification d’un menu ========== */

function enregistrerMenu(
    PDO $pdo,
    array $post,
    ?int $menuId = null
): ?string
{
    try {
        /* ========== Transaction ========== */

        $pdo->beginTransaction();

        /* ========== Normalisation des données formulaire ========== */

        $data = [
            'nom'                => trim($post['titre'] ?? ''),
            'description'        => trim($post['description'] ?? ''),
            'description_longue' => trim($post['description_complete'] ?? ''),
            'theme'              => trim($post['theme'] ?? ''),
            'regime'             => $post['regime'] ?? '',
            'nb_personnes_min'   => (int) ($post['minimum'] ?? 0),
            'prix_base'          => (float) ($post['prix'] ?? 0),
            'stock'              => (int) ($post['stock'] ?? 0),
        ];

        /* ========== Validation minimale ========== */

        if (
            !$data['nom'] ||
            !$data['prix_base'] ||
            !$data['nb_personnes_min']
        ) {
            return "Les champs obligatoires ne sont pas remplis.";
        }

        /* ========== Enregistrement du menu ========== */

        saveMenu($pdo, $data, $menuId);

        $menuId = $menuId ?: $pdo->lastInsertId();

        /* ========== Association des plats ========== */

        $platsIds = array_map('intval', $post['plats'] ?? []);

        /* Suppression des anciennes associations */
        $pdo->prepare("
            DELETE FROM menu_plat
            WHERE menu_id = ?
        ")->execute([$menuId]);

        /* Insertion des nouvelles associations */
        if (!empty($platsIds)) {
            $stmt = $pdo->prepare("
                INSERT INTO menu_plat (menu_id, plat_id)
                VALUES (?, ?)
            ");

            foreach ($platsIds as $platId) {
                $stmt->execute([$menuId, $platId]);
            }
        }

        /* ========== Image du menu (héritée d’un plat) ========== */

        $stmt = $pdo->prepare("
            SELECT image
            FROM plat
            WHERE id IN (
                SELECT plat_id
                FROM menu_plat
                WHERE menu_id = ?
            )
            AND image IS NOT NULL
            LIMIT 1
        ");
        $stmt->execute([$menuId]);

        $image = $stmt->fetchColumn();

        if ($image) {
            $pdo->prepare("
                UPDATE menu
                SET image = ?
                WHERE id = ?
            ")->execute([$image, $menuId]);
        }

        /* ========== Validation transaction ========== */

        $pdo->commit();
        return null;

    } catch (Exception $e) {

        /* ========== Rollback en cas d’erreur ========== */

        $pdo->rollBack();
        return "Erreur lors de l'enregistrement du menu.";
    }
}

/* ========== Construction des filtres menus (front) ========== */

function buildMenuFilters(array $query): array
{
    return [
        'theme'            => $query['theme'] ?? null,
        'regime'           => $query['regime'] ?? null,
        'nb_personnes_min' => $query['nb_personnes_min'] ?? null,
        'prix_max'         => $query['prix_max'] ?? null,
        'fourchette_prix'  => $query['fourchette_prix'] ?? null,
    ];
}
