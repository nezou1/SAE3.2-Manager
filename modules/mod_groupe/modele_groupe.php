<?php

require_once(PROJECT_ROOT . '/core/connexion.php');

class ModeleGroupe extends Connexion {

    public function addGroupe($nom, $modifiableParEtudiant) {
        $bdd = Connexion::getConnexion();
        $sql = "INSERT INTO Groupe (nom, modifiable_par_etudiant) VALUES (:nom, :modifiable_par_etudiant)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'modifiable_par_etudiant' => $modifiableParEtudiant
        ]);
        return $bdd->lastInsertId(); 
    }

    public function lierEtudiantsAuGroupe($idGroupe, $etudiants) {
        if (empty($etudiants)) {
            return;
        }
        $bdd = Connexion::getConnexion();
        $sql = "INSERT INTO estDansLeGroupe (idGroupe, idEtud) VALUES (:idGroupe, :idEtud)";
        $stmt = $bdd->prepare($sql);
        foreach ($etudiants as $idEtudiant) {
            $stmt->execute([
                'idGroupe' => $idGroupe,
                'idEtud' => $idEtudiant
            ]);
        }
    }

    public function getGroupes() {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT * FROM Groupe";
        $stmt = $bdd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEtudiants() {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT * FROM Etudiant";
        $stmt = $bdd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
