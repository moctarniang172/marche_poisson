<?php
class Depence{
    private  $table = "depances";
    private $user_id;
    private  $montant;
    private $motif; 
    private  $date;

    public function __construct($user_id,$montant,$motif, $date) {
        $this->user_id = $user_id;
        $this->montant = $montant;
        $this->motif = $motif;
        $this->date = $date_vente ?? date('Y-m-d');
       
    }

    public function addDepence($conn){
        $query = "INSERT INTO $this->table(user_id,montant,motif,date_depense)VALUES (:user_id,:montant,:motif,:date_depense)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id',$this->user_id);
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
 
    //recuperer les depences par utilisateur pour l'admin
    public static function getDepensesByUser($connexion, $user_id){
    $sql = "SELECT * FROM depances WHERE user_id = :user_id ORDER BY date_depense DESC";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    

}