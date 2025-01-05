<?php

require_once('/Users/nezhaelfayez/Desktop/IUT/S3/PHP/local_html/SAE3.2-Manager/core/connexion.php');

class ModeleInscription extends Connexion {

    public function inscrire($nom, $prenom, $email, $password, $profil, $activation_key) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $req = "INSERT INTO Utilisateur (nom, prenom, login, password, profil, activation_key) 
                VALUES (:nom, :prenom, :login, :password, :profil, :activation_key)";
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'login' => $email,
            'password' => $hash,
            'profil' => $profil,
            'activation_key' => $activation_key
        ]);
    }

    public function getUserByEmail($email) {
        $bdd = Connexion::getConnexion(); // Récupérer la connexion depuis la classe Connexion
        $req = "SELECT * FROM Utilisateur WHERE login = :login";
        $pdo_req = $bdd->prepare($req);
        $pdo_req->execute(['login' => $email]);
        return $pdo_req->fetch();
    }
}

