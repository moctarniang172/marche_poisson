<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../mes_classes/Database.php';
require_once '../mes_classes/Vente.php';

$conn = (new Database())->getConnection();
$paiement = new Vente($conn,null,null,null,null,null);

// Récupérer le nom depuis le formulaire
$nom_client = $_GET['nom_client'] ?? '';

// Appeler la fonction de filtrage
$dettes = [];
if(!empty($nom_client)) {
    $dettes = $paiement->filtrage($conn, $nom_client);
}

// Inclure la vue
require '../views/liste_dettes.php';
