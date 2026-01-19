<?php
function verifierEligibiliteAvis(PDO $pdo, int $commandeId, int $userId): array
{
    $commande = getCommandeById($pdo, $commandeId);

    if (
        !$commande ||
        (int)$commande['utilisateur_id'] !== $userId ||
        $commande['statut'] !== 'terminee'
    ) {
        return ['error' => 'Accès non autorisé'];
    }

    if (avisExistePourCommande($pdo, $commandeId)) {
        return ['error' => 'Avis déjà existant'];
    }

    return ['commande' => $commande];
}


function traiterDepotAvis(PDO $pdo, int $commandeId, array $post): ?string
{
    $note = (int)($post['note'] ?? 0);
    $commentaire = trim($post['commentaire'] ?? '');

    if ($note < 1 || $note > 5) {
        return 'Veuillez sélectionner une note.';
    }

    insertAvis($pdo, $commandeId, $note, $commentaire);
    return null;
}

