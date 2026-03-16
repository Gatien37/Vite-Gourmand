<?php

require_once __DIR__ . '/../repositories/sql/commandeRepository.php';

class CommandeService
{
    private PDO $pdo;
    private CommandeRepository $commandeRepository;

    public function __construct(PDO $pdo, CommandeRepository $commandeRepository)
    {
        $this->pdo = $pdo;
        $this->commandeRepository = $commandeRepository;
    }

    public function creerCommande(array $data): int
    {
        $commandeId = $this->commandeRepository->insertCommande($data);
        $this->commandeRepository->insertCommandeSuivi($commandeId, $data['statut']);

        return $commandeId;
    }

    public function modifierCommande(int $commandeId, array $data): void
    {
        $this->commandeRepository->updateCommande($commandeId, $data);
    }

    public function changerStatut(int $commandeId, string $statut): void
    {
        $this->commandeRepository->updateCommandeStatut($commandeId, $statut);
        $this->commandeRepository->insertCommandeSuivi($commandeId, $statut);
    }

    public function marquerCommeLivreeAvecPret(int $commandeId): string
    {
        $dateLimite = $this->calculerDateLimiteRetour();
        $statut = 'attente_retour_materiel';

        $this->commandeRepository->updateCommandePretMateriel($commandeId, $statut, $dateLimite);
        $this->commandeRepository->insertCommandeSuivi($commandeId, $statut);

        return $dateLimite;
    }

    public function changerStatutDepuisEmploye(int $commandeId, string $statut): ?string
    {
        if ($statut === 'attente_retour_materiel') {
            return $this->marquerCommeLivreeAvecPret($commandeId);
        }

        $this->changerStatut($commandeId, $statut);
        return null;
    }

    private function calculerDateLimiteRetour(): string
    {
        $date = new DateTime();
        $joursAjoutes = 0;

        while ($joursAjoutes < 3) {
            $date->modify('+1 day');

            if ((int) $date->format('N') < 6) {
                $joursAjoutes++;
            }
        }

        return $date->format('Y-m-d');
    }

    public function modifierCommandeUtilisateur(array $commande, array $post): ?string
    {
        $date = trim($post['date_prestation'] ?? '');
        $heure = trim($post['heure_prestation'] ?? '');
        $adresse = trim($post['adresse'] ?? '');
        $ville = trim($post['ville'] ?? '');
        $nbPersonnes = (int) ($post['nb_personnes'] ?? 0);

        if ($date === '' || $heure === '' || $adresse === '' || $ville === '' || $nbPersonnes <= 0) {
            return 'Tous les champs sont obligatoires.';
        }

        $datePrestation = $date . ' ' . $heure . ':00';

        $prixBase = (float) $commande['prix_base'];
        $prixTotal = $prixBase * $nbPersonnes;

        $data = [
            'date_prestation' => $datePrestation,
            'adresse' => $adresse,
            'ville' => $ville,
            'nb_personnes' => $nbPersonnes,
            'prix_total' => $prixTotal
        ];

        $this->modifierCommande((int) $commande['id'], $data);

        return null;
    }

    public function traiterCommande(array $menu, array $post, array $utilisateur): array
{
    require_once __DIR__ . '/../config/commandeStatus.php';
    require_once __DIR__ . '/livraisonService.php';
    require_once __DIR__ . '/../repositories/sql/menuRepository.php';

    try {
        $this->pdo->beginTransaction();

        $statut = STATUT_EN_ATTENTE;

        $nb        = (int) ($post['nb_personnes'] ?? 0);
        $date      = $post['date'] ?? null;
        $heure     = $post['heure'] ?? null;
        $reception = $post['reception'] ?? null;

        $adresse = trim($post['adresse'] ?? '');
        $ville   = trim($post['ville'] ?? '');
        $cp      = trim($post['code_postal'] ?? '');

        if ($nb < (int) $menu['nb_personnes_min'] || !$date || !$heure || !$reception) {
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

        if ((int) $menu['stock'] < $nb) {
            return ['error' => 'Stock insuffisant pour ce menu'];
        }

        $prixMenu = $nb * (float) $menu['prix_base'];
        $reduction = ($nb >= ((int) $menu['nb_personnes_min'] + 5))
            ? $prixMenu * 0.10
            : 0;

        $fraisLivraison = calculerFraisLivraison(
            $reception,
            $adresse,
            $ville,
            $cp
        );

        $total = $prixMenu - $reduction + $fraisLivraison;

        $commandeId = $this->creerCommande([
            'utilisateur_id' => (int) $utilisateur['id'],
            'menu_id' => (int) $menu['id'],
            'date_prestation' => "$date $heure",
            'adresse' => $reception === 'livraison' ? $adresse : 'Retrait sur place',
            'ville' => $reception === 'livraison' ? $ville : 'Bordeaux',
            'nb_personnes' => $nb,
            'prix_total' => $total,
            'statut' => $statut
        ]);

        ajusterStockMenu($this->pdo, (int) $menu['id'], $nb);

        $this->pdo->commit();

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
        if ($this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }

        return ['error' => 'Erreur lors de la création de la commande'];
    }
}
}