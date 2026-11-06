<?php
// Point d'entrée : choisit le contrôleur selon le paramètre "page"
require __DIR__ . '/../config/Database.php';
require __DIR__ . '/../models/Collection.php';
require __DIR__ . '/../models/Pompier.php';
require __DIR__ . '/../models/Periode.php';
require __DIR__ . '/../models/Caserne.php';
require __DIR__ . '/../models/GardeModel.php';
require __DIR__ . '/../controllers/FeuilleController.php';
require __DIR__ . '/../controllers/AppelController.php';

$page = $_GET['page'] ?? 'feuille';

if ($page === 'appel') {
    $controller = new AppelController();
} else {
    $controller = new FeuilleController();
}
$controller->afficher();
