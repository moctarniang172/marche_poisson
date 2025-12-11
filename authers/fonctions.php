<?php
if(session_status()=== PHP_SESSION_NONE){
    session_start();

}
function verfierConnexion(){
    if(!isset($_SESSION['user_id'])){
        header("location: ../views/connexion.php");
    }
}
function redirectIfLogged() {
    if (isset($_SESSION['user_id'])) {
        header("Location: ../views/ajouter_vente.php");
        exit();
    }
}
function verifierAdmin(){
    if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== "admin"){
        // l'utilisateur n'a pas le droit → on le renvoie
        header("Location: ../views/ajouter_vente.php");
        exit;
    }
}
