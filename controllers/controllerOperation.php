<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require ('../mes_classes/Database.php');
require ('../mes_classes/Vente.php');
require ('../authers/fonctions.php');

//  Vérification de la session
verfierConnexion();

// Récupération de l'ID utilisateur connecté
$user_id = $_SESSION['user_id'] ?? null;

$db = new Database();

$connexion= $db->getConnection();

$liste = new Vente($user_id,$connexion,null,null,null,null,null);

$operation = $liste->filtragePaiement($connexion,$user_id,);

include '../views/operation.php';