<?php
/* ========== Vérification de l’éligibilité à déposer un avis ========== */

function verifierEligibiliteAvis(PDO $pdo, int $commandeId, int $userId): array
{
    /* ========== Récupération de la commande ========== */

    $commande = getCommandeById($pdo, $commandeId);

    /* ========== Vérifications de sécurité et de statut ========== */

    if (
        !$commande ||
        (int) $commande['utilisateur_id'] !== $userId ||
        $commande['statut'] !== 'terminee'
    ) {
        return ['error' => 'Accès non autorisé'];
    }

    /* ========== Vérification d’un avis déjà existant ========== */

    if (avisExistePourCommande($pdo, $commandeId)) {
        return ['error' => 'Avis déjà existant'];
    }

    /* ========== Commande éligible ========== */

    return ['commande' => $commande];
}

/* ========== Traitement du dépôt d’un avis ========== */

function traiterDepotAvis(PDO $pdo, int $commandeId, array $post): ?string
{
    /* ========== Récupération et normalisation des données ========== */

    $note        = (int) ($post['note'] ?? 0);
    $commentaire = trim($post['commentaire'] ?? '');

    /* ========== Validation de la note ========== */

    if ($note < 1 || $note > 5) {
        return 'Veuillez sélectionner une note.';
    }

    /* ========== Insertion de l’avis en base ========== */

    insertAvis($pdo, $commandeId, $note, $commentaire);

    return null;
}
