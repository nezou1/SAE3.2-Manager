<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function inscrire($nom, $prenom, $email, $password, $profil, $activation_key) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = $this->db->prepare("INSERT INTO utilisateurs (nom, prenom, email, password, profil, activation_key) 
                                     VALUES (:nom, :prenom, :email, :password, :profil, :activation_key)");
        $query->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $hash,
            'profil' => $profil,
            'activation_key' => $activation_key
        ]);
    }

    public function getUserByEmail($email) {
        $query = $this->db->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $query->execute(['email' => $email]);
        return $query->fetch();
    }
}