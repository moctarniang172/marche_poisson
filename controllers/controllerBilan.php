<?php

ini_set('display_errors',1);
ini_set('display_stratup_errors',1);
error_reporting(E_ALL);

require('../mes_classes/Database.php');
require('../mes_classes/fonction.php');
require ('../authers/fonctions.php');

//  Vérification de la session
verfierConnexion();

// Récupération de l'ID utilisateur connecté
$user_id = $_SESSION['user_id'] ?? null;

$db = new Database();
$conn = $db->getConnection();

$fonction = new Fonction();

// Date choisie ou date du jour
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

/* --- Totaux --- */
$totaux_ventes   = $fonction->totaliteVentes($conn,$user_id, $date);
$totaux_avance   = $fonction->totaliteAvance($conn, $user_id,$date);
$totaux_restant  = $fonction->totaliteRestant($conn, $user_id,$date);
$totalDepenses   = $fonction->totalDepenses($conn, $user_id,$date);

$dette_jour      = $fonction->dettesPayeDuJour($conn, $user_id,$date);
$ancienne_dettes = $fonction->anciennesDettes($conn, $user_id,$date);

/* --- Encaissé total --- */
$encaissements = $totaux_avance + $dette_jour + $ancienne_dettes;

/* --- Solde --- */
$solde = $encaissements - $totalDepenses;

/* --- Listes détaillées --- */
$ventes_jour     = $fonction->ventesDuJour($conn, $user_id,$date);
$paiements_jour  = $fonction->paiementsDuJour($conn, $user_id,$date);
$depenses_jour   = $fonction->depensesDuJour($conn, $user_id,$date);

/* --- Charger la vue --- */
include('../views/bilan.php');
