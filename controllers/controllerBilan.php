<?php

ini_set('display_errors',1);
ini_set('display_stratup_errors',1);
error_reporting(E_ALL);

require('../mes_classes/Database.php');
require('../mes_classes/fonction.php');

$db = new Database();
$conn = $db->getConnection();

$fonction = new Fonction();

// Date choisie ou date du jour
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

/* --- Totaux --- */
$totaux_ventes   = $fonction->totaliteVentes($conn, $date);
$totaux_avance   = $fonction->totaliteAvance($conn, $date);
$totaux_restant  = $fonction->totaliteRestant($conn, $date);
$totalDepenses   = $fonction->totalDepenses($conn, $date);

$dette_jour      = $fonction->dettesPayeDuJour($conn, $date);
$ancienne_dettes = $fonction->anciennesDettes($conn, $date);

/* --- Encaissé total --- */
$encaissements = $totaux_avance + $dette_jour + $ancienne_dettes;

/* --- Solde --- */
$solde = $encaissements - $totalDepenses;

/* --- Listes détaillées --- */
$ventes_jour     = $fonction->ventesDuJour($conn, $date);
$paiements_jour  = $fonction->paiementsDuJour($conn, $date);
$depenses_jour   = $fonction->depensesDuJour($conn, $date);

/* --- Charger la vue --- */
include('../views/bilan.php');
