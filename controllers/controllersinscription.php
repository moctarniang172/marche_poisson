<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('../mes_classes/Database.php');
require('../mes_classes/User.php');

$db = new Database();
$connexion = $db->getConnection();

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $mdp1 = $_POST['mdp1'];
    $mdp2 = $_POST['mdp2'];

    $users = new User($nom,$prenom,$telephone,$mdp1,$mdp2);

    $users2 = $users->registre($connexion);
    if($users2){
        header("location: ../views/connexion.php?success=1");
    }
}