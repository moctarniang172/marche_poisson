<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require('../mes_classes/Database.php');
require('../mes_classes/User.php');

$db = new Database();
$connexion = $db->getConnection();

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $telephone = $_POST['telephone'];
    $mdp = $_POST['password'];

    $user = User::connexion($connexion, $telephone, $mdp);

    if($user){
        // créer session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['user_role']= $user['role'];
        
        // Redirection selon le rôle
    if($_SESSION['user_role'] === 'admin'){
        header("Location: ../views/admins/dashboard.php");
        exit;
    } else {
        header("Location: ../views/ajouter_vente.php");
        exit;
    }
    } else {
        header("Location: ../views/connexion.php?error=1");
        exit;
    }
}
