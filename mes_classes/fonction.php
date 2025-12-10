<?php
class Fonction {

    /* ---------------- TOTAL VENTES ---------------- */
    public function totaliteVentes($conn, $user_id, $date) {
        $sql = "SELECT SUM(total) AS total_ventes 
                FROM ventes  WHERE user_id = :user_id AND DATE(date_vente) = :date";
                
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id'=> $user_id,'date'=> $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_ventes'] ?? 0;
    }

    /* ---------------- TOTAL AVANCES ---------------- */
    public function totaliteAvance($conn, $user_id, $date) {
        $sql = "SELECT SUM(avance) AS total_avance FROM ventes WHERE user_id = :user_id AND DATE(date_vente) = :date";     
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 'user_id' => $user_id,'date'=> $date ]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_avance'] ?? 0;
    }

    /* ---------------- TOTAL RESTES ---------------- */
    public function totaliteRestant($conn, $user_id, $date) {
        $sql = "SELECT SUM(reste) AS total_reste FROM ventes WHERE user_id = :user_id AND DATE(date_vente) = :date";    
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id,'date'=> $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_reste'] ?? 0;
    }

    /* ---------------- TOTAL DEPENSES ---------------- */
    public function totalDepenses($conn, $user_id, $date) {
        $sql = "SELECT SUM(montant) AS total_depenses FROM depances WHERE user_id = :user_id AND DATE(date_depense) = :date";     
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id,'date'=> $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_depenses'] ?? 0;
    }

    /* ---------------- DETTES PAYÉES DU JOUR ---------------- */
    public function dettesPayeDuJour($conn, $user_id, $date) {
        $sql = "SELECT SUM(p.montant) AS dette_du_jour
                FROM paiements p
                INNER JOIN ventes v ON p.id_vente = v.id
                WHERE v.user_id = :user_id AND DATE(p.date_paiement) = :dateAND DATE(v.date_vente) = :date";
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 'user_id' => $user_id,'date'=> $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['dette_du_jour'] ?? 0;
    }

    /* ---------------- ANCIENNES DETTES ENCAISSÉES ---------------- */
    public function anciennesDettes($conn, $user_id, $date) {
        $sql = "SELECT SUM(p.montant) AS anciennes_dettes
                FROM paiements p
                INNER JOIN ventes v ON p.id_vente = v.id
                WHERE v.user_id = :user_id
                AND DATE(p.date_paiement) = :date
                AND DATE(v.date_vente) != :date";

        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id,'date'=> $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['anciennes_dettes'] ?? 0;
    }

    /* ---------------- LISTE DES VENTES DU JOUR ---------------- */
    public function ventesDuJour($conn, $user_id, $date) {
        $sql = "SELECT * FROM ventes  WHERE user_id = :user_id AND DATE(date_vente) = :date  ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 'user_id' => $user_id,'date'=> $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ---------------- LISTE DES PAIEMENTS DU JOUR ---------------- */
    public function paiementsDuJour($conn, $user_id, $date) {
        $sql = "SELECT p.*, v.nom_client, v.date_vente
                FROM paiements p
                INNER JOIN ventes v ON p.id_vente = v.id
                WHERE v.user_id = :user_id
                AND DATE(p.date_paiement) = :date";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'date'    => $date
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ---------------- LISTE DES DEPENSES DU JOUR ---------------- */
    public function depensesDuJour($conn, $user_id, $date) {
        $sql = "SELECT * FROM depances WHERE user_id = :user_id AND DATE(date_depense) = :date ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id,'date'=> $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
