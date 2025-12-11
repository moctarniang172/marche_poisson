<?php

class Admin
{
    /* ---------------- LISTE DE TOUS LES UTILISATEURS ---------------- */
    public static function getUsers($conn)
    {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ---------------- RECUPERER UN UTILISATEUR ---------------- */
    public function getUser($conn, $id)
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ---------------- AJOUTER UN UTILISATEUR ---------------- */
    public function addUser($conn, $nom, $email, $password, $role)
    {
        $sql = "INSERT INTO users(nom, email, password, role)
                VALUES (:nom, :email, :password, :role)";
                
        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            'nom'      => $nom,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => $role
        ]);
    }

    /* ---------------- MODIFIER UN UTILISATEUR ---------------- */
    public function updateUser($conn, $id, $nom,$prenom, $telephone, $role)
    {
        $sql = "UPDATE users SET nom = :nom, prenom = :prenom, telephone = :telephone, role = :role 
                WHERE id = :id";
        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            'id'      => $id,
            'nom'     => $nom,
            'prenom' =>$prenom,
            'telephone'   => $telephone,
            'role'    => $role
        ]);
    }

    /* ---------------- SUPPRIMER UN UTILISATEUR ---------------- */
    public function deleteUser($conn, $id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
