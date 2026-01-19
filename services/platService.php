<?php
function enregistrerPlat(PDO $pdo, array $post, ?int $platId = null): ?string
{
    $nom  = trim($post['nom'] ?? '');
    $type = $post['type'] ?? '';
    $allergenesIds = array_map('intval', $post['allergenes'] ?? []);

    if (!$nom || !$type) {
        return "Tous les champs sont obligatoires.";
    }

    if (!in_array($type, ['entree', 'plat', 'dessert'])) {
        return "Type de plat invalide.";
    }

    try {
        $pdo->beginTransaction();

        savePlat($pdo, [
            'nom'  => $nom,
            'type' => $type
        ], $platId);

        $platId = $platId ?: $pdo->lastInsertId();

        $pdo->prepare("DELETE FROM plat_allergene WHERE plat_id = ?")
            ->execute([$platId]);

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
