<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

// Chargement des dépendances
require '../mes_classes/Database.php';
require '../mes_classes/Depence.php';
require_once '../authers/fonctions.php';

//  Vérification de la session
verfierConnexion();

// Récupération de l'ID utilisateur connecté
$user_id = $_SESSION['user_id'] ?? null;


$db = new Database();
$connexion = $db->getConnection();


$depences = new Depence("", "", "", "");

//  Charger la liste avant modification
$liste = $depences->getDepense($connexion);

//  Traitement de l’ajout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $montant = $_POST['montant'] ?? null;
    $motif   = $_POST['motif']   ?? null;
    $date    = date('Y-m-d');

    // Vérification minimale
    if (!empty($montant) && !empty($motif)) {

        $depAjouter = new Depence($user_id, $montant, $motif, $date);
        $depAjouter->addDepence($connexion);

        // Recharger la liste après insertion
        $liste = $depences->getDepense($connexion);
    }
}

// Charger la vue
include '../views/depences.php';
