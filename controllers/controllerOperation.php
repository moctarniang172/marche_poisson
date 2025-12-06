<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require ('../mes_classes/Database.php');
require ('../mes_classes/Vente.php');

$db = new Database();
$connexion= $db->getConnection();

$liste = new Vente($connexion,null,null,null,null,null);

$operation = $liste->operation($connexion);

include '../views/operation.php';