<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

require ('../mes_classes/Database.php');
require('../mes_classes/Depence.php');

$db = new Database();
$connexion = $db->getConnection();

$depences = new Depence("", "", "");

// 🔹 Toujours charger la liste AVANT l'ajout
$liste = $depences->getDepense($connexion);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $montant = $_POST['montant'];
    $motif   = $_POST['motif'];
    $date    = date('Y-m-d');

    $depAjouter = new Depence($montant, $motif, $date);
    $depAjouter->addDepence($connexion);

    // 🔹 Recharger la liste après insertion
    $liste = $depences->getDepense($connexion);
}

// charger la vue
include '../views/depences.php';
