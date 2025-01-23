<?php

require_once('../core/connexion.php');

class ModeleInscription extends Connexion {

    public function inscrire($nom, $prenom, $email, $password, $profil, $activation_key) {
        try {
            $bdd = self::getConnexion();
            $bdd->beginTransaction();

            if ($profil == 'etudiant') {
                $req = "INSERT INTO Etudiant (nom, prenom, email) VALUES (:nom, :prenom, :email)";
            } else {
                $req = "INSERT INTO Enseignant (nom, prenom, email) VALUES (:nom, :prenom, :email)";
            }

            $pdo_req = $bdd->prepare($req);
            $pdo_req->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email
            ]);

            $req = "INSERT INTO Utilisateur (nom, prenom, login, password, profil, activation_key) 
                    VALUES (:nom, :prenom, :login, :password, :profil, :activation_key)";
            $pdo_req = $bdd->prepare($req);
            $pdo_req->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'login' => $email,
                'password' => $password,
                'profil' => $profil,
                'activation_key' => $activation_key
            ]);

            $bdd->commit();
        } catch (Exception $e) {
            $bdd->rollBack();
            error_log("Erreur lors de l'inscription : " . $e->getMessage());
            throw new Exception("Une erreur est survenue lors de l'inscription. Veuillez réessayer plus tard.");
        }
    }

    public function getUserByEmail($email) {
        $bdd = self::getConnexion();
        $req = "SELECT * FROM Utilisateur WHERE login = :email";
        $pdo_req = $bdd->prepare($req);
        $pdo_req->execute(['email' => $email]);
        return $pdo_req->fetch(PDO::FETCH_ASSOC);
    }
}