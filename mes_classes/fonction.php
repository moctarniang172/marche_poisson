<?php
class Fonction {

    /* ---------------- TOTAL VENTES ---------------- */
    public function totaliteVentes($conn, $date) {
        $sql = "SELECT SUM(total) AS total_ventes 
                FROM ventes 
                WHERE DATE(date_vente) = :date";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['date' => $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_ventes'] ?? 0;
    }

    /* ---------------- TOTAL AVANCES ---------------- */
    public function totaliteAvance($conn, $date) {
        $sql = "SELECT SUM(avance) AS total_avance 
                FROM ventes 
                WHERE DATE(date_vente) = :date";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['date' => $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_avance'] ?? 0;
    }

    /* ---------------- TOTAL RESTES ---------------- */
    public function totaliteRestant($conn, $date) {
        $sql = "SELECT SUM(reste) AS total_reste 
                FROM ventes 
                WHERE DATE(date_vente) = :date";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['date' => $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_reste'] ?? 0;
    }

    /* ---------------- DEPENSES ---------------- */
   public function totalDepenses($conn, $date) {
    $sql = "SELECT SUM(montant) AS total_depenses 
            FROM depances 
            WHERE date_depense = :date";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':date' => $date]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total_depenses'] ?? 0;
}


    /* ---------------- DETTES PAYÉES (du jour) ---------------- */
    public function dettesPayeDuJour($conn, $date) {
        $sql = "SELECT SUM(p.montant) AS dette_du_jour
                FROM paiements p
                INNER JOIN ventes v ON p.id_vente = v.id
                WHERE DATE(p.date_paiement) = :date 
                AND DATE(v.date_vente) = :date";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['date' => $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['dette_du_jour'] ?? 0;
    }

    /* ---------------- ANCIENNES DETTES ENCAISSÉES ---------------- */
    public function anciennesDettes($conn, $date) {
        $sql = "SELECT SUM(p.montant) AS anciennes_dettes
                FROM paiements p
                INNER JOIN ventes v ON p.id_vente = v.id
                WHERE DATE(p.date_paiement) = :date 
                AND DATE(v.date_vente) != :date";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['date' => $date]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['anciennes_dettes'] ?? 0;
    }

    /* ---------------- LISTE DES VENTES DU JOUR ---------------- */
    public function ventesDuJour($conn, $date) {
        $sql = "SELECT * FROM ventes WHERE DATE(date_vente) = :date";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['date' => $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ---------------- LISTE DES PAIEMENTS DU JOUR ---------------- */
    public function paiementsDuJour($conn, $date) {
        $sql = "SELECT p.*, v.nom_client, v.date_vente
                FROM paiements p
                INNER JOIN ventes v ON p.id_vente = v.id
                WHERE DATE(p.date_paiement) = :date";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['date' => $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ---------------- LISTE DEPENSES DU JOUR ---------------- */
    public function depensesDuJour($conn, $date) {
        $sql = "SELECT * FROM depances WHERE date_depense = :date";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['date' => $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
