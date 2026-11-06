<?php
// Affiche la feuille de garde (annexe A)
class FeuilleController
{
    public function afficher(): void
    {
        $model = new GardeModel();
        $volontaires = $model->getVolontaires();
        $tranches = $model->getTranches();
        $dates = $model->getDates();

        // Tableau [volontaire][date][tranche] = ['dispo' => ..., 'garde' => ...]
        $grille = [];
        foreach ($model->getActivites() as $a) {
            $grille[$a['idVolontaire']][$a['datePeriode']][$a['idTranche']] = [
                'dispo' => $a['idDisponibilite'],
                'garde' => $a['deGarde']
            ];
        }

        require __DIR__ . '/../views/feuille.php';
    }
}
