<?php

require_once('../core/connexion.php');

class ModeleGroupe extends Connexion {
    private $bdd;

    public function __construct() {
        $this->bdd = Connexion::getConnexion(); }

    public function addGroupe($nom, $modifiableParEtudiant) {
        $sql = "INSERT INTO Groupe (nom, modifiable_par_etudiant) VALUES (:nom, :modifiable_par_etudiant)";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute([
            'nom' => htmlspecialchars(trim($nom)),
            'modifiable_par_etudiant' => $modifiableParEtudiant
        ]);
        return $this->getConnexion()->lastInsertId();
    }

    public function lierEtudiantsAuGroupe($idGroupe, $etudiants) {
        if (empty($etudiants)) {
            return;
        }
        $sql = "INSERT INTO estDansLeGroupe (idGroupe, idEtud) VALUES (:idGroupe, :idEtud)";
        $stmt = $this->getConnexion()->prepare($sql);
        foreach ($etudiants as $idEtudiant) {
            $stmt->execute([
                'idGroupe' => $idGroupe,
                'idEtud' => $idEtudiant
            ]);
        }
    }

    public function getGroupes() {
        $sql = "SELECT idGroupe, nom, modifiable_par_etudiant FROM Groupe";
        $stmt = $this->getConnexion()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEtudiants() {
        $sql = "SELECT idEtud, nom, prenom, email FROM Etudiant";
        $stmt = $this->getConnexion()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIdEtudiant($email) {
        $sql = "SELECT idEtud FROM Etudiant WHERE email = :email";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['idEtud'];
    }

    public function getGroupesParEtudiant($idEtudiant) {
        $sql = "SELECT G.idGroupe, G.nom, G.modifiable_par_etudiant 
                FROM Groupe G
                INNER JOIN estDansLeGroupe EG ON G.idGroupe = EG.idGroupe
                WHERE EG.idEtud = :idEtudiant";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute(['idEtudiant' => $idEtudiant]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMembresGroupe($idGroupe) {
        $sql = "SELECT E.nom, E.prenom, E.email 
                FROM Etudiant E
                INNER JOIN estDansLeGroupe EG ON E.idEtud = EG.idEtud
                WHERE EG.idGroupe = :idGroupe";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute(['idGroupe' => $idGroupe]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
