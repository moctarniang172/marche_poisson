<?php
require_once('../../mes_classes/Database.php');
require_once('../../mes_classes/Vente.php');
require_once('../../mes_classes/Depence.php');
require_once('../../mes_classes/Bilan.php');
require_once('../../mes_classes/User.php');
require_once('../../mes_classes/Admin.php');
require_once('../../authers/fonctions.php');
verifierAdmin(); // sécurisation

$db = new Database();
$conn = $db->getConnection();

$users = Admin::getUsers($conn);

$datas = [];

foreach($users as $u){
    $datas[$u['id']] = [
        "user"     => $u,
        "ventes"   => Vente::getVentesByUser($conn, $u['id']),
        "depenses" => Depence::getDepensesByUser($conn, $u['id']),
        "bilan"    => Bilan::getBilanGlobal($conn, $u['id'])
    ];
}

return $datas;
?>