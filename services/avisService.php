<?php

require_once __DIR__ . '/../repositories/sql/avisRepository.php';
require_once __DIR__ . '/../repositories/sql/commandeRepository.php';

class AvisService
{
    private PDO $pdo;
    private AvisRepository $avisRepository;
    private CommandeRepository $commandeRepository;

    public function __construct(PDO $pdo, AvisRepository $avisRepository, CommandeRepository $commandeRepository)
    {
        $this->pdo = $pdo;
        $this->avisRepository = $avisRepository;
        $this->commandeRepository = $commandeRepository;
    }

    public function verifierEligibiliteAvis(int $commandeId, int $userId): array
    {
        $commande = $this->commandeRepository->getCommandeById($commandeId);

        if (
            !$commande ||
            (int) $commande['utilisateur_id'] !== $userId ||
            $commande['statut'] !== 'terminee'
        ) {
            return ['error' => 'Accès non autorisé'];
        }

        if ($this->avisRepository->avisExistePourCommande($commandeId)) {
            return ['error' => 'Avis déjà existant'];
        }

        return ['commande' => $commande];
    }

    public function traiterDepotAvis(int $commandeId, array $post): ?string
    {
        $note = (int) ($post['note'] ?? 0);
        $commentaire = trim($post['commentaire'] ?? '');

        if ($note < 1 || $note > 5) {
            return 'Veuillez sélectionner une note.';
        }

        $this->avisRepository->insertAvis($commandeId, $note, $commentaire);

        return null;
    }

    public function getAvisValides(int $limit = 3): array
    {
        return $this->avisRepository->getAvisValides($limit);
    }

    public function getAllAvis(): array
    {
        return $this->avisRepository->getAllAvis();
    }

    public function setAvisValide(int $avisId, bool $valide): void
    {
        $this->avisRepository->setAvisValide($avisId, $valide);
    }
}