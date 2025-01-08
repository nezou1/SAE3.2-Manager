<?php

class ModeleDepot extends Connexion {

    public function getDepotsByProjet($idProjet, $idGroupe) {
        $sql = "SELECT * FROM depot WHERE idProjet = :idProjet AND idGroupe = :idGroupe ORDER BY dateEnvoyee DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'idProjet' => $idProjet,
            'idGroupe' => $idGroupe
        ]);
        return $stmt->fetchAll();
    }

    public function addDepot($idProjet, $idGroupe, $descriptif, $dateEnvoyee) {
        $sql = "INSERT INTO depot (idProjet, idGroupe, descriptif, dateEnvoyee) VALUES (:idProjet, :idGroupe, :descriptif, :dateEnvoyee)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'idProjet' => $idProjet,
            'idGroupe' => $idGroupe,
            'descriptif' => $descriptif,
            'dateEnvoyee' => $dateEnvoyee
        ]);
    }

    public function getProjetDetails($idProjet) {
        $sql = "SELECT * FROM projet WHERE idProjet = :idProjet";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'idProjet' => $idProjet
        ]);
        return $stmt->fetch();
    }

    public function getGroupesByProjet($idProjet) {
        $sql = "SELECT * FROM groupe WHERE idProjet = :idProjet";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'idProjet' => $idProjet
        ]);
        return $stmt->fetchAll();
    }
}
