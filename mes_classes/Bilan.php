<?php
class Bilan{
       public static function getBilanGlobal($connexion, $user_id){
    // Total ventes
    $sqlV = "SELECT SUM(total) AS total_ventes FROM ventes WHERE user_id = :id";
    $stmtV = $connexion->prepare($sqlV);
    $stmtV->bindParam(':id', $user_id);
    $stmtV->execute();
    $total_ventes = $stmtV->fetch(PDO::FETCH_ASSOC)['total_ventes'] ?? 0;

    // Total dépenses
    $sqlD = "SELECT SUM(montant) AS total_depenses FROM depances WHERE user_id = :id";
    $stmtD = $connexion->prepare($sqlD);
    $stmtD->bindParam(':id', $user_id);
    $stmtD->execute();
    $total_depenses = $stmtD->fetch(PDO::FETCH_ASSOC)['total_depenses'] ?? 0;

    // Solde restant
    $solde = $total_ventes - $total_depenses;

    return [
        "ventes" => $total_ventes,
        "depenses" => $total_depenses,
        "solde" => $solde
    ];
}
}