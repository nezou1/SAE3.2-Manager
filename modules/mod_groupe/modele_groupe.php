<?php

require_once(PROJECT_ROOT . '/core/connexion.php');

class ModeleGroupe extends Connexion {

    public function addGroupe($nom, $modifiableParEtudiant) {
        $bdd = Connexion::getConnexion();
        $sql = "INSERT INTO Groupe (nom, modifiable_par_etudiant) VALUES (:nom, :modifiable_par_etudiant)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'nom' => htmlspecialchars(trim($nom)),
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
        $sql = "SELECT idGroupe, nom, modifiable_par_etudiant FROM Groupe";
        $stmt = $bdd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEtudiants() {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT idEtud, nom, prenom, email FROM Etudiant";
        $stmt = $bdd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGroupesParEtudiant($idEtudiant) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT G.idGroupe, G.nom, G.modifiable_par_etudiant 
                FROM Groupe G
                INNER JOIN estDansLeGroupe EG ON G.idGroupe = EG.idGroupe
                WHERE EG.idEtud = :idEtudiant";

        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idEtudiant' => $idEtudiant]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMembresGroupe($idGroupe) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT E.nom, E.prenom, E.email 
                FROM Etudiant E
                INNER JOIN estDansLeGroupe EG ON E.idEtud = EG.idEtud
                WHERE EG.idGroupe = :idGroupe";

        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idGroupe' => $idGroupe]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
