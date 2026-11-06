<?php
// Gère l'appel d'une équipe pour une intervention
class AppelController
{
    public function afficher(): void
    {
        $model = new GardeModel();
        $dates = $model->getDates();
        $tranches = $model->getTranches();
        $erreur = null;
        $appeles = null;   // liste des pompiers appelés
        $nbAppeles = 0;
        $nbDemandes = 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date = $_POST['date'] ?? '';
            $tranche = (int) ($_POST['tranche'] ?? 0);
            $nbDemandes = (int) ($_POST['nbPompiers'] ?? 0);

            if ($nbDemandes < 1 || !$model->getPeriode($date, $tranche)) {
                $erreur = "Période ou nombre de pompiers invalide.";
            } else {
                // 1. Création des objets Pompier à partir de la BDD
                $pompiers = [];
                foreach ($model->getVolontaires() as $v) {
                    $pompiers[$v['id']] = new Pompier($v['nom'], $v['prenom'], $v['numeroBip']);
                }

                // 2. Création de la Période et de la Caserne avec les pompiers de garde
                $periode = new Periode($date, $tranche);
                $caserne = new Caserne();
                foreach ($model->getGardesPeriode($date, $tranche) as $g) {
                    $pompier = $pompiers[$g['idVolontaire']];
                    $caserne->AjouterPompier($pompier);
                    if ($g['idDisponibilite'] == 3) {
                        $periode->AjouterDisponible($pompier);
                    } elseif ($g['idDisponibilite'] == 2) {
                        $periode->AjouterAuTravail($pompier);
                    }
                }

                // 3. Appel de l'équipe
                $nbAppeles = $caserne->AppelEquipe($periode, $nbDemandes);

                // 4. Pompiers passés en mission = pompiers appelés
                $appeles = [];
                foreach ($pompiers as $p) {
                    if ($p->GetStatut($periode) === 'm') {
                        $appeles[] = $p . ' (bip ' . $p->GetNumeroBip() . ')';
                    }
                }
            }
        }

        require __DIR__ . '/../views/appel.php';
    }
}
