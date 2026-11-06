<?php
// Accès à la base de données (requêtes SQL)
class GardeModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnexion();
    }

    public function getVolontaires(): array
    {
        return $this->pdo->query("SELECT id, nom, prenom, numeroBip FROM VOLONTAIRE ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTranches(): array
    {
        return $this->pdo->query("SELECT id, libelle FROM TRANCHE ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
    }

    // Liste des dates pour lesquelles il existe des périodes de garde
    public function getDates(): array
    {
        return $this->pdo->query("SELECT DISTINCT datePeriode FROM PERIODE_GARDE ORDER BY datePeriode")->fetchAll(PDO::FETCH_COLUMN);
    }

    // Une période de garde (ou false si elle n'existe pas)
    public function getPeriode(string $date, int $tranche)
    {
        $req = $this->pdo->prepare("SELECT idTranche, datePeriode, nbPompiers FROM PERIODE_GARDE WHERE datePeriode = ? AND idTranche = ?");
        $req->execute([$date, $tranche]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    // Toutes les disponibilités / gardes (pour la feuille de garde)
    public function getActivites(): array
    {
        return $this->pdo->query("SELECT idVolontaire, idTranche, datePeriode, idDisponibilite, deGarde FROM AVOIR_ACTIVITE")->fetchAll(PDO::FETCH_ASSOC);
    }

    // Volontaires désignés de garde pour une période, avec leur disponibilité
    public function getGardesPeriode(string $date, int $tranche): array
    {
        $req = $this->pdo->prepare("SELECT idVolontaire, idDisponibilite FROM AVOIR_ACTIVITE WHERE datePeriode = ? AND idTranche = ? AND deGarde = 1");
        $req->execute([$date, $tranche]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
