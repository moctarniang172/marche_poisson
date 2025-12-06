<?php
class Depence{
    private  $table = "depances";
    private  $montant;
    private $motif; 
    private  $date;

    public function __construct($montant,$motif, $date) {
        $this->montant = $montant;
        $this->motif = $motif;
        $this->date = $date_vente ?? date('Y-m-d');
       
    }

    public function addDepence($conn){
        $query = "INSERT INTO $this->table(montant,motif,date_depense)VALUES (:montant,:motif,:date_depense)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':montant',$this->montant);
        $stmt->bindParam(':motif',$this->motif);
        $stmt->bindParam(':date_depense',$this->date);
        return $stmt->execute();
    }


    //liset des dpenses
    public function getDepense($conn){
        $query = "SELECT * FROM depances";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    

}