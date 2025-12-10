<?php
// afficher les erreurs (pour le développement)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../mes_classes/Database.php";
require_once "../mes_classes/Vente.php";
require_once "../authers/fonctions.php";

//  Vérification de la session
verfierConnexion();

// Récupération de l'ID utilisateur connecté
$user_id = $_SESSION['user_id'] ?? null;

$db = new Database();
$connexion=$db->getConnection();
$vente = new Vente($user_id,$connexion, null, null, null, null, null);

// Récupérer la liste des dettes
$listeDettes = $vente->getDettes($connexion);

// Charger la vue
include "../views/liste.php";
