<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../mes_classes/Database.php';
require '../mes_classes/Vente.php';

$db = new Database();
$conn = $db->getConnection();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['id_vente'], $_POST['montant'])) {
        die("Erreur : données manquantes.");
    }

    $id_vente = intval($_POST['id_vente']);
    $montant = floatval($_POST['montant']);

    $vente = new Vente($conn,null,null,null,null,null,null);
    $resultat = $vente->enregistrerPaiement($conn, $montant, $id_vente);
    if ($resultat) {
        echo "<p style='color:green;text-align:center'>Paiement enregistré avec succès !</p>";
        header("Refresh: 2; URL=../views/liste.php");
        exit;
    } else {
        echo "<p style='color:red;text-align:center'>Erreur lors de l’enregistrement.</p>";
    }
}
