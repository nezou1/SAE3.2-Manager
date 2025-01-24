<?php

class ModeleSoutenance extends Connexion {

        public function get_soutenances() {
            $req = "SELECT s.idSoutenance, s.description, s.dateSout, s.lieu, s.heureDebut, s.heureFin, 
                           g.nom AS nomGroupe, p.titre AS projet, s.idGroupe, s.idProjet
                    FROM Soutenance s
                    JOIN Groupe g ON s.idGroupe = g.idGroupe
                    JOIN Projet p ON s.idProjet = p.idProjet
                    ORDER BY s.dateSout, s.heureDebut";
            $stmt = self::$bdd->query($req);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    
        public function ajout($description, $date, $heureDebut, $heureFin, $lieu, $idGroupe, $idProjet) {
            if (!$this->groupeExiste($idGroupe) || !$this->projetExiste($idProjet)) {
                throw new Exception("Groupe ou projet invalide.");
            }
    
            $sql = "INSERT INTO Soutenance (description, dateSout, heureDebut, heureFin, lieu, idGroupe, idProjet) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = self::$bdd->prepare($sql);
            $stmt->execute([$description, $date, $heureDebut, $heureFin, $lieu, $idGroupe, $idProjet]);
        }
    
        public function groupeExiste($idGroupe) {
            $stmt = self::$bdd->prepare("SELECT COUNT(*) FROM Groupe WHERE idGroupe = ?");
            $stmt->execute([$idGroupe]);
            return $stmt->fetchColumn() > 0;
        }
    
        public function projetExiste($idProjet) {
            $stmt = self::$bdd->prepare("SELECT COUNT(*) FROM Projet WHERE idProjet = ?");
            $stmt->execute([$idProjet]);
            return $stmt->fetchColumn() > 0;
        }
    
        public function getSoutenancesEtudiant($idEtudiant) {
            $sql = "SELECT s.idSoutenance, s.description, s.dateSout, s.heureDebut, s.heureFin, s.lieu, 
                           g.nom AS groupe, p.titre AS projet
                    FROM Soutenance s
                    JOIN Groupe g ON s.idGroupe = g.idGroupe
                    JOIN Projet p ON s.idProjet = p.idProjet
                    JOIN estDansLeGroupe edg ON g.idGroupe = edg.idGroupe
                    WHERE edg.idEtud = ?
                    ORDER BY s.dateSout, s.heureDebut";
        
            $stmt = self::$bdd->prepare($sql);
            $stmt->execute([$idEtudiant]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    
        public function get_groupes() {
            $stmt = self::$bdd->query("SELECT idGroupe, nom FROM Groupe ORDER BY nom");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function get_projets() {
            $stmt = self::$bdd->query("SELECT idProjet, titre FROM Projet ORDER BY titre");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function supprimerSoutenance($idSoutenance) {
            $sql = "DELETE FROM Soutenance WHERE idSoutenance = ?";
            $stmt = self::$bdd->prepare($sql);
            return $stmt->execute([$idSoutenance]);
        }

    public function mesSoutenancesEtudiant($idEtudiant) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT s.idSoutenance, s.description, s.dateSout, s.heureDebut, s.heureFin, s.lieu, g.nom as nom_groupe
                FROM Soutenance s
                JOIN Groupe g ON s.idGroupe = g.idGroupe
                JOIN estDansLeGroupe edg ON g.idGroupe = edg.idGroupe
                WHERE edg.idEtud = :idEtudiant
                ORDER BY s.dateSout, s.heureDebut";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idEtudiant' => $idEtudiant]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>