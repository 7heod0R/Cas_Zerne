<?php
// Classe Pompier (annexes B et C)
class Pompier
{
    private $nom;
    private $prenom;
    private $numeroBip;

    public function __construct(string $nom, string $prenom, string $numeroBip)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numeroBip = $numeroBip;
    }

    // Retourne le numéro de bip du pompier
    public function GetNumeroBip(): string
    {
        return $this->numeroBip;
    }

    // Retourne le statut du pompier pour la période : 'm', 't' ou 'd'
    public function GetStatut(Periode $unePeriode): string
    {
        return $unePeriode->GetStatut($this);
    }

    // Passe le pompier en mission pour la période
    public function Missionner(Periode $unePeriode): void
    {
        $unePeriode->Missionner($this);
    }

    // Utile pour l'affichage (hors annexe)
    public function __toString(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
