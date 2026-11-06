<?php
// Classe Caserne (annexes B et C)
class Caserne
{
    private $lesPompiers;   // pompiers de garde pour la caserne

    public function __construct()
    {
        $this->lesPompiers = new Collection();
    }

    // Méthode de chargement (ajoutée) : remplit lesPompiers
    public function AjouterPompier(Pompier $unPompier): void
    {
        $this->lesPompiers->Ajouter($unPompier);
    }

    // Appelle automatiquement le bip (simulé ici par une trace dans le journal PHP)
    private function Appeler(string $numeroBip): void
    {
        error_log("Appel du bip n° " . $numeroBip);
    }

    // Appelle une équipe pour la période, change leur statut
    // et retourne le nombre de pompiers appelés
    public function AppelEquipe(Periode $unePeriode, int $nbPompiers): int
    {
        $equipe = $unePeriode->SelectEquipe($nbPompiers);

        for ($i = 0; $i < $equipe->Cardinal(); $i++) {
            $pompier = $equipe->Extraire($i);
            $pompier->Missionner($unePeriode);
            $this->Appeler($pompier->GetNumeroBip());
        }
        return $equipe->Cardinal();
    }
}
