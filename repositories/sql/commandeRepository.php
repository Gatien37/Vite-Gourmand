<?php

class CommandeRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertCommande(array $data): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO commande
            (utilisateur_id, menu_id, date_prestation, adresse, ville, nb_personnes, prix_total, statut)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['utilisateur_id'],
            $data['menu_id'],
            $data['date_prestation'],
            $data['adresse'],
            $data['ville'],
            $data['nb_personnes'],
            $data['prix_total'],
            $data['statut']
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function insertCommandeSuivi(int $commandeId, string $statut): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO commande_suivi (commande_id, statut)
            VALUES (?, ?)
        ");

        $stmt->execute([$commandeId, $statut]);
    }

    public function updateCommande(int $commandeId, array $data): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE commande
            SET 
                date_prestation = :date_prestation,
                adresse = :adresse,
                ville = :ville,
                nb_personnes = :nb_personnes,
                prix_total = :prix_total
            WHERE id = :id
        ");

        $stmt->execute([
            'date_prestation' => $data['date_prestation'],
            'adresse' => $data['adresse'],
            'ville' => $data['ville'],
            'nb_personnes' => $data['nb_personnes'],
            'prix_total' => $data['prix_total'],
            'id' => $commandeId
        ]);
    }

    public function updateCommandeStatut(int $commandeId, string $statut): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE commande
            SET statut = :statut
            WHERE id = :id
        ");

        $stmt->execute([
            'statut' => $statut,
            'id' => $commandeId
        ]);
    }

    public function updateCommandePretMateriel(
        int $commandeId,
        string $statut,
        string $dateLimite
    ): void {
        $stmt = $this->pdo->prepare("
            UPDATE commande
            SET
                pret_materiel = 1,
                date_limite_retour = :date_limite,
                statut = :statut
            WHERE id = :id
        ");

        $stmt->execute([
            'date_limite' => $dateLimite,
            'statut' => $statut,
            'id' => $commandeId
        ]);
    }

    public function getCommandeById(int $id): array|false
    {
        $sql = "
            SELECT 
                c.id,
                c.utilisateur_id,
                c.menu_id,
                c.date_prestation,
                c.adresse,
                c.ville,
                c.nb_personnes AS quantite,
                c.prix_total,
                c.statut,
                u.nom AS client_nom,
                u.email AS client_email,
                u.gsm AS client_gsm,
                m.nom AS menu_nom,
                m.prix_base,
                m.nb_personnes_min,
                m.stock
            FROM commande c
            JOIN menu m ON c.menu_id = m.id
            JOIN utilisateur u ON c.utilisateur_id = u.id
            WHERE c.id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCommandesByUtilisateur(int $utilisateurId): array
    {
        $sql = "
            SELECT 
                c.id,
                c.date_prestation,
                c.prix_total,
                c.statut,
                c.pret_materiel,
                c.date_limite_retour,
                m.nom AS menu_nom
            FROM commande c
            JOIN menu m ON c.menu_id = m.id
            WHERE c.utilisateur_id = :utilisateur_id
            ORDER BY c.date_prestation DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['utilisateur_id' => $utilisateurId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCommandesAvecDetails(): array
    {
        $sql = "
            SELECT
                c.id,
                c.date_prestation,
                c.prix_total,
                c.statut,
                c.pret_materiel,
                c.date_limite_retour,
                u.nom AS client_nom,
                u.prenom AS client_prenom,
                m.nom AS menu_nom
            FROM commande c
            JOIN utilisateur u ON c.utilisateur_id = u.id
            JOIN menu m ON c.menu_id = m.id
            ORDER BY c.date_prestation DESC
        ";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommandeSuivi(int $commandeId): array
    {
        $sql = "
            SELECT statut, date_statut
            FROM commande_suivi
            WHERE commande_id = :id
            ORDER BY date_statut ASC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $commandeId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommandesFiltrees(?string $statut, ?string $client): array
    {
        $sql = "
            SELECT 
                c.id,
                c.date_prestation,
                c.prix_total,
                c.statut,
                c.date_limite_retour,
                u.nom AS client_nom,
                u.email AS client_email,
                m.nom AS menu_nom
            FROM commande c
            JOIN utilisateur u ON c.utilisateur_id = u.id
            JOIN menu m ON c.menu_id = m.id
            WHERE 1 = 1
        ";

        $params = [];

        if (!empty($statut)) {
            $sql .= " AND c.statut = :statut";
            $params['statut'] = $statut;
        }

        if (!empty($client)) {
            $sql .= " AND (u.nom LIKE :client OR u.email LIKE :client)";
            $params['client'] = '%' . $client . '%';
        }

        $sql .= " ORDER BY c.date_prestation ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMotifAnnulation(int $commandeId): ?array
    {
        $sql = "
            SELECT motif, contact_mode, created_at
            FROM commande_actions
            WHERE commande_id = :commande_id
              AND action = 'annuler'
            ORDER BY created_at DESC
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['commande_id' => $commandeId]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getDerniereModificationCommande(int $commandeId): ?array
    {
        $sql = "
            SELECT contact_mode, motif, created_at
            FROM commande_actions
            WHERE commande_id = :commande_id
              AND action = 'modifier'
            ORDER BY created_at DESC
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['commande_id' => $commandeId]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getCommandeEditableParEmploye(int $id): array|false
    {
        $sql = "
            SELECT 
                c.id,
                c.utilisateur_id,
                c.menu_id,
                c.date_prestation,
                c.adresse,
                c.ville,
                c.nb_personnes AS quantite,
                c.prix_total,
                c.statut,
                u.nom AS client_nom,
                u.email AS client_email,
                u.gsm AS client_gsm,
                m.nom AS menu_nom,
                m.prix_base,
                m.nb_personnes_min,
                m.stock
            FROM commande c
            JOIN menu m ON c.menu_id = m.id
            JOIN utilisateur u ON c.utilisateur_id = u.id
            WHERE c.id = :id
              AND c.statut IN ('en_attente', 'acceptee')
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}