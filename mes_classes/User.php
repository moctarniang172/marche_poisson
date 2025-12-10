<?php
class User{
    private string $table = "users";
    private string $nom;
    private string $prenom;
    private int $telephone;
    private string $mdp1;
    private string $mdp2;
    
    public function __construct(string $nom,string $prenom, int $telephone, string $mdp1, string $mdp2){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
        $this->mdp1 = $mdp1;
        $this->mdp2 = $mdp2;
    }

    public function registre($conn){

        // Vérification des mots de passe
        if($this->mdp1 !== $this->mdp2){
            return "Les mots de passe ne correspondent pas.";
        }

        // Hash du mot de passe
        $mot_de_passe_hash = password_hash($this->mdp1, PASSWORD_DEFAULT);

        // INSERT : on ne stocke que le mdp hashé !
        $query = "INSERT INTO $this->table(nom, prenom, telephone, mdp1)
                  VALUES(:nom, :prenom, :telephone, :mdp1)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':telephone', $this->telephone);
        $stmt->bindParam(':mdp1', $mot_de_passe_hash);

        return $stmt->execute();
    }

    // Connexion
    public static function connexion($conn, $telephone, $password){
        $query = "SELECT * FROM users WHERE telephone = :telephone LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Vérification du mot de passe hashé
        if($user && password_verify($password, $user['mdp1'])){
            return $user;
        }

        return false;
    }
}
