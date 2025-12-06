<?php
//afficher les erreurs (pour le développement)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1️⃣ On inclut les fichiers nécessaires
require_once '../mes_classes/Database.php';
require_once '../mes_classes/Vente.php';

// 2️⃣ On vérifie que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 3️⃣ On récupère les données du formulaire
    $nom_client = $_POST['nom_client'];
    $poisson = $_POST['poisson'];
    $poids = $_POST['poids'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $avance = $_POST['avance'];
    $reste = $_POST['reste'];
  
    // 4️⃣ On crée une instance de Database et on récupère la connexion
    $db = new Database();
    $connexion = $db->getConnection();

    // 5️⃣ On crée un objet Vente avec les données du formulaire
    $vente = new Vente($nom_client, $poisson, $poids, $prix_unitaire, $avance, null);
    // 6️⃣ On enregistre la vente dans la base de données
    try {
        $vente->enregistrerVente($connexion);
        // 7️⃣ Message de succès et redirection
        echo "<p style='color:green;'>Vente enregistrée avec succès !</p>";
        header("Refresh: 2; URL=../index.php");

    } catch (Exception $e) {
        // 8️⃣ En cas d'erreur, on l'affiche
        echo "<p style='color:red;'>Erreur : " . $e->getMessage() . "</p>";
    }
} else {
    // 9️⃣ Si on arrive sur cette page sans soumettre le formulaire
    echo "<p>Accès direct interdit. <a href='index.php'>Retour</a></p>";
}
?>
