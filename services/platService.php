<?php
/* =====================================================
   CRÉATION / MODIFICATION D’UN PLAT
   ===================================================== */

function enregistrerPlat(PDO $pdo, array $post, ?int $platId = null): ?string
{
    /* ========== Nettoyage des données ========== */

    $nom  = trim($post['nom'] ?? '');
    $type = $post['type'] ?? '';
    $allergenesIds = array_map('intval', $post['allergenes'] ?? []);

    /* ========== Validations métier ========== */

    if (!$nom || !$type) {
        return "Tous les champs sont obligatoires.";
    }

    if (!in_array($type, ['entree', 'plat', 'dessert'], true)) {
        return "Type de plat invalide.";
    }

    try {
        /* ========== Transaction ========== */

        $pdo->beginTransaction();

        /* ========== Enregistrement plat (create/update) ========== */

        savePlat($pdo, [
            'nom'  => $nom,
            'type' => $type
        ], $platId);

        /* Récupération de l’id en création */
        $platId = $platId ?: $pdo->lastInsertId();

        /* ========== Réinitialisation des allergènes ========== */

        $pdo->prepare("
            DELETE FROM plat_allergene
            WHERE plat_id = ?
        ")->execute([$platId]);

        /* ========== Réinsertion des allergènes sélectionnés ========== */

        if (!empty($allergenesIds)) {
            $stmt = $pdo->prepare("
                INSERT INTO plat_allergene (plat_id, allergene_id)
                VALUES (?, ?)
            ");

            foreach ($allergenesIds as $allergeneId) {
                $stmt->execute([$platId, $allergeneId]);
            }
        }

        $pdo->commit();
        return null;

    } catch (Exception $e) {

        $pdo->rollBack();
        return "Erreur lors de l'enregistrement du plat.";
    }
}
