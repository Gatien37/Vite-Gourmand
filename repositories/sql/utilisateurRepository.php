<?php

class UtilisateurRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUtilisateurByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM utilisateur
            WHERE email = :email
        ");

        $stmt->execute([
            'email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getUtilisateurById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("
            SELECT
                id,
                prenom,
                nom,
                email,
                gsm,
                adresse,
                ville,
                code_postal
            FROM utilisateur
            WHERE id = :id
        ");

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function updateAdresseUtilisateur(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE utilisateur
            SET
                adresse = :adresse,
                ville = :ville,
                code_postal = :code_postal
            WHERE id = :id
        ");

        $stmt->execute([
            'adresse' => $data['adresse'],
            'ville' => $data['ville'],
            'code_postal' => $data['code_postal'],
            'id' => $id
        ]);
    }

    public function getEmployes(): array
    {
        return $this->pdo->query("
            SELECT
                id,
                prenom,
                nom,
                email,
                actif
            FROM utilisateur
            WHERE role = 'employe'
            ORDER BY nom
        ")->fetchAll(PDO::FETCH_ASSOC);
    }
}