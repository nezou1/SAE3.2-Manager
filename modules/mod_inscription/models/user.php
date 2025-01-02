<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function inscrire($nom, $prenom, $email, $password, $profil, $activation_key) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = $this->db->prepare("INSERT INTO Utilisateur (nom, prenom, login, password, profil, activation_key) 
                                     VALUES (:nom, :prenom, :login, :password, :profil, :activation_key)");
        $query->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'login' => $email,
            'password' => $hash,
            'profil' => $profil,
            'activation_key' => $activation_key
        ]);
    }

    public function getUserByEmail($email) {
        $query = $this->db->prepare("SELECT * FROM Utilisateur WHERE login = :login");
        $query->execute(['login' => $email]);
        return $query->fetch();
    }

    public function saveResetToken($userId, $token) {
        $query = $this->db->prepare("UPDATE Utilisateur SET reset_token = :token WHERE id = :id");
        $query->execute([
            'token' => $token,
            'id' => $userId
        ]);
    }
    
    public function getUserByResetToken($token) {
        $query = $this->db->prepare("SELECT * FROM Utilisateur WHERE reset_token = :token");
        $query->execute(['token' => $token]);
        return $query->fetch();
    }    
    
}
