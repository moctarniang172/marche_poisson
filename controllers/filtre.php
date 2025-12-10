<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once '../mes_classes/Database.php';
require_once '../mes_classes/Vente.php';
require ('../authers/fonctions.php');

//  Vérification de la session
verfierConnexion();

// Récupération de l'ID utilisateur connecté
$user_id = $_SESSION['user_id'] ?? null;

$conn = (new Database())->getConnection();
$paiement = new Vente($conn,null,null,null,null,null,null);

// Récupérer le nom depuis le formulaire
$nom_client = $_GET['nom_client'] ?? '';

// Appeler la fonction de filtrage
$dettes = [];
if(!empty($nom_client)) {
    $dettes = $paiement->filtrage($conn, $user_id,$nom_client);
}else{
    $dettes = $paiement->operation($conn,$user_id);
}


// Inclure la vue
require '../views/operation.php';
