<?php

class Vente{
    private $user_id;
    private $nom_client;
    private $poisson;
    private $poids;
    private $prix_unitaire;
    private $total;
    private $avance;
    private $reste;
    private $date_vente;


    //constructeur pour ques les attributs soient initialisés lors de la création d'un objet Vente

    public function __construct($user_id,$nom_client, $poisson, $poids, $prix_unitaire, $avance, $date_vente){
        $this->user_id = $user_id;
        $this->nom_client = $nom_client;
        $this->poisson = $poisson;
        $this->poids = $poids;
        $this->prix_unitaire = $prix_unitaire;
        $this->total = $poids * $prix_unitaire;
        $this->avance = $avance;
        $this->reste = $this->total - $avance;
        $this->date_vente = $date_vente ?? date('Y-m-d');
    }

    //pour enregistrer une vente
    public function enregistrerVente($conn){
        $query = "INSERT INTO ventes (user_id,nom_client, poisson, poids, prix_unitaire, total, avance, reste, date_vente) 
                  VALUES (:user_id,:nom_client, :poisson, :poids, :prix_unitaire, :total, :avance, :reste, :date_vente)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':nom_client', $this->nom_client);
        $stmt->bindParam(':poisson', $this->poisson);
        $stmt->bindParam(':poids', $this->poids);
        $stmt->bindParam(':prix_unitaire', $this->prix_unitaire);
        $stmt->bindParam(':total', $this->total);
        $stmt->bindParam(':avance', $this->avance);
        $stmt->bindParam(':reste', $this->reste);
        $stmt->bindParam(':date_vente', $this->date_vente);
        return $stmt->execute();

}

//recuperer les ventes
public function getDettes($conn,$user_id)
{
    $sql = "SELECT * FROM ventes WHERE user_id = :user_id AND reste >00 ORDER BY date_vente DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id',$this->user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//recuperer tout les ventes d'un utilisateur
public function getventes($conn,$user_id,$date)
{
    $sql = "SELECT * FROM ventes WHERE user_id = :user_id AND date_vente = :date ORDER BY date_vente DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $this->user_id);
    $stmt->bindParam(':date', $this->$date);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//methode pour paiememnt de dette
public function enregistrerPaiement($conn, $montant, $id_vente)
{
    // 1. Ajouter le paiement dans la table paiements
    $stmt = $conn->prepare("INSERT INTO paiements (id_vente, montant)VALUES (:id_vente, :montant)");
    $stmt->execute([':id_vente' => $id_vente,':montant' => $montant ]);

    // 2. Mettre à jour l'avance
    $stmt2 = $conn->prepare(" UPDATE ventes SET avance = avance + :montant WHERE id = :id ");
    $stmt2->execute([ ':montant' => $montant, ':id' => $id_vente ]);

    // 3. Recalculer le reste proprement
    $stmt3 = $conn->prepare("UPDATE ventes SET reste = GREATEST(total - avance, 0)  WHERE id = :id ");
    $stmt3->execute([':id'=> $id_vente]);

    return true;
}

public function operation($conn,$user_id) {
    $sql = "SELECT 
            p.id AS paiement_id,
            p.id_vente,
            p.montant,
            p.date_paiement,
            v.nom_client,
            v.poisson,
            v.poids,
            v.total,
            v.avance,
            v.reste
        FROM paiements AS p
        INNER JOIN ventes AS v 
            ON p.id_vente = v.id
        WHERE v.user_id = :user_id
        ORDER BY p.date_paiement DESC ";
    $query = $conn->prepare($sql);
    $query->execute(['user_id' => $user_id]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

//systeme de filtrage pour les dettes a payer
public function filtrage($conn,$user_id, $nom) {
  $query = "SELECT 
            p.id_vente, 
            p.montant, 
            p.date_paiement, 
            v.nom_client, 
            v.poisson, 
            v.poids, 
            v.total,
            v.reste, 
            v.date_vente
          FROM paiements AS p
          INNER JOIN ventes AS v ON p.id_vente = v.id
          WHERE v.nom_client LIKE :nom AND v.user_id = :user_id
          ORDER BY p.date_paiement DESC";

    $stmt = $conn->prepare($query);
    // Ajouter les valeurs liées
    $stmt->bindParam(':user_id',$user_id);
    $stmt->bindValue(':nom', '%' . $nom . '%'); // les % pour le LIKE
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//syteme de filtrage pour la liste des dettes posibles
public function filtragedette($conn,$user_id,$nom){
    $query = "SELECT * FROM ventes WHERE reste >0 AND user_id = :user_id AND nom_client LIKE :nom ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id',$user_id);
    $stmt->bindValue(':nom', '%' . $nom . '%');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function filtragePaiement($conn,$nom)
{
    $query = "SELECT 
                p.id_vente,
                p.montant,
                p.date_paiement,
                v.nom_client,
                v.poisson,
                v.poids,
                v.reste,
                v.date_vente
              FROM paiements AS p
              INNER JOIN ventes AS v ON p.id_vente = v.id
              WHERE v.user_id = :user_id
                AND v.nom_client LIKE :nom
              ORDER BY p.date_paiement DESC";

    $stmt = $conn->prepare($query);

    $stmt->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
    $stmt->bindValue(':nom', '%' . $nom . '%', PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//liste des dettes
public function listedette($conn,$user_id){
    $query = "SELECT * FROM ventes WHERE user_id = :user_id AND reste >00";
    $stmt= $conn->prepare($query);
    $stmt->bindParam('user_id',$user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}