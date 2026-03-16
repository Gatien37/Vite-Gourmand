<?php

class AvisRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function avisExistePourCommande(int $commandeId): bool
    {
        $stmt = $this->pdo->prepare("
            SELECT id
            FROM avis
            WHERE commande_id = :id
        ");

        $stmt->execute(['id' => $commandeId]);

        return (bool) $stmt->fetch();
    }

    public function insertAvis(int $commandeId, int $note, string $commentaire): void
    {
        if ($this->avisExistePourCommande($commandeId)) {
            throw new RuntimeException('Avis déjà existant pour cette commande.');
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO avis (commande_id, note, commentaire)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([$commandeId, $note, $commentaire]);
    }

    public function getAvisValides(int $limit = 3): array
    {
        $sql = "
            SELECT 
                a.note,
                a.commentaire,
                u.prenom,
                u.nom
            FROM avis a
            JOIN commande c ON a.commande_id = c.id
            JOIN utilisateur u ON c.utilisateur_id = u.id
            WHERE a.valide = 1
            ORDER BY a.id DESC
            LIMIT :limit
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllAvis(): array
    {
        $sql = "
            SELECT 
                a.id,
                a.note,
                a.commentaire,
                a.valide,
                c.id AS commande_id,
                u.prenom,
                u.nom
            FROM avis a
            JOIN commande c ON a.commande_id = c.id
            JOIN utilisateur u ON c.utilisateur_id = u.id
            ORDER BY a.id DESC
        ";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setAvisValide(int $avisId, bool $valide): void
    {
        $stmt = $this->pdo->prepare("
            UPDATE avis
            SET valide = :valide
            WHERE id = :id
        ");

        $stmt->execute([
            'valide' => $valide ? 1 : 0,
            'id' => $avisId
        ]);
    }
}