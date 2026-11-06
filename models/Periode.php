<?php
// Classe Periode (annexes B et C)
class Periode
{
    private $laDate;       // date de la période de garde
    private $laTranche;    // tranche (1, 2, 3 ou 4)
    private $enMission;    // pompiers déjà en intervention
    private $auTravail;    // pompiers au travail chez leur employeur
    private $disponible;   // pompiers disponibles à leur domicile

    public function __construct(string $uneDate, int $uneTranche)
    {
        $this->laDate = $uneDate;
        $this->laTranche = $uneTranche;
        $this->enMission = new Collection();
        $this->auTravail = new Collection();
        $this->disponible = new Collection();
    }

    // Méthodes de chargement (ajoutées) : remplissent les collections depuis la BDD
    public function AjouterDisponible(Pompier $unPompier): void
    {
        $this->disponible->Ajouter($unPompier);
    }

    public function AjouterAuTravail(Pompier $unPompier): void
    {
        $this->auTravail->Ajouter($unPompier);
    }

    // Retourne 'm' (en mission), 't' (au travail) ou 'd' (disponible)
    public function GetStatut(Pompier $unPompier): string
    {
        if ($this->enMission->Contient($unPompier)) {
            return 'm';
        }
        if ($this->auTravail->Contient($unPompier)) {
            return 't';
        }
        if ($this->disponible->Contient($unPompier)) {
            return 'd';
        }
        return '';
    }

    // Passe le pompier de "disponible" ou "auTravail" à "enMission"
    public function Missionner(Pompier $unPompier): void
    {
        if ($this->disponible->Contient($unPompier)) {
            $this->disponible->Enlever($unPompier);
        } elseif ($this->auTravail->Contient($unPompier)) {
            $this->auTravail->Enlever($unPompier);
        } else {
            return; // déjà en mission ou inconnu
        }
        $this->enMission->Ajouter($unPompier);
    }

    // Retourne au maximum $nbPompiers pompiers : d'abord les disponibles,
    // puis ceux au travail. Le statut n'est pas modifié.
    public function SelectEquipe(int $nbPompiers): Collection
    {
        $equipe = new Collection();

        for ($i = 0; $i < $this->disponible->Cardinal() && $equipe->Cardinal() < $nbPompiers; $i++) {
            $equipe->Ajouter($this->disponible->Extraire($i));
        }
        for ($i = 0; $i < $this->auTravail->Cardinal() && $equipe->Cardinal() < $nbPompiers; $i++) {
            $equipe->Ajouter($this->auTravail->Extraire($i));
        }
        return $equipe;
    }
}
