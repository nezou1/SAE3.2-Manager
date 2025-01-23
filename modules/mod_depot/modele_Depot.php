<?php

class ModeleDepot extends Connexion {

    public function getDepotsByProjet($idProjet, $idGroupe) {
        $sql = "SELECT * FROM Rendu WHERE idProjet = :idProjet AND idGroupe = :idGroupe ORDER BY dateEnvoyee DESC";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute([
            'idProjet' => intval($idProjet),
            'idGroupe' => intval($idGroupe)
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addDepot($idProjet, $idGroupe, $descriptif, $dateEnvoyee, $fichier, $nomFichier) {
        $sql = "INSERT INTO Rendu (descriptif, dateEnvoyee, idProjet, idGroupe, fichier, nomFichier) 
                VALUES (:descriptif, :dateEnvoyee, :idProjet, :idGroupe, :fichier, :nomFichier)";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute([
            'descriptif' => $descriptif,
            'dateEnvoyee' => $dateEnvoyee,
            'idProjet' => intval($idProjet),
            'idGroupe' => intval($idGroupe),
            'fichier' => $fichier,
            'nomFichier' => $nomFichier
        ]);
    }

    public function getFichierById($idRendu) {
        $sql = "SELECT fichier, nomFichier FROM Rendu WHERE idRendu = :idRendu";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute(['idRendu' => intval($idRendu)]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProjetDetails($idProjet) {
        $sql = "SELECT * FROM Projet WHERE idProjet = :idProjet";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute(['idProjet' => intval($idProjet)]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllProjets() {
        $sql = "SELECT * FROM Projet";
        $stmt = $this->getConnexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
