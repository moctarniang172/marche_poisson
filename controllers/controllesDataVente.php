<?php
//afficher les erreurs (pour le développement)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1️⃣ On inclut les fichiers nécessaires
require_once '../mes_classes/Database.php';
require_once '../mes_classes/Vente.php';
require_once '../mes_classes/fonction.php';
require_once('../authers/fonctions.php');

 //  Vérification de la session
 verfierConnexion();

// Récupération de l'ID utilisateur connecté
$user_id = $_SESSION['user_id'] ?? null;

 $db = new Database();
$connexion = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_client = $_POST['nom_client'];
    $poisson = $_POST['poisson'];
    $poids = $_POST['poids'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $avance = $_POST['avance'];
    $reste = $_POST['reste'];
  
    // On crée une instance de Database et on récupère la connexion
   

    //  On crée un objet Vente avec les données du formulaire
    $vente = new Vente($user_id,$nom_client, $poisson, $poids, $prix_unitaire, $avance, null);
    
    try {
        $vente->enregistrerVente($connexion);
        //  Message de succès et redirection
        echo "<p style='color:green;'>Vente enregistrée avec succès !</p>";
        header("Refresh: 2; URL=../views/ajouter_vente.php");

    } catch (Exception $e) {
        //  En cas d'erreur, on l'affiche
        echo "<p style='color:red;'>Erreur : " . $e->getMessage() . "</p>";
    }
} else {
    // Si on arrive sur cette page sans soumettre le formulaire
    echo "<p>Accès direct interdit. <a href='index.php'>Retour</a></p>";
}

?>
