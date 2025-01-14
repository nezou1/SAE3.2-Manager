<?php


require_once(PROJECT_ROOT .'/core/connexion.php');
class ModeleListe extends Connexion {

    public function listeEtudiant() {
        // Connexion à la base de données
        $bdd = Connexion::getConnexion();
    
        // Requête SQL pour récupérer les étudiants
        $sql = "SELECT idEtud, nom, prenom, email FROM Etudiant";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
    
        // Tableau pour stocker les étudiants
        $etudiants = [];
    
        // Parcourir les résultats et les ajouter au tableau
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $etudiants[] = $row;
        }
    
        // Retourner le tableau des étudiants
        return $etudiants;
    }

    public function supprimerEtudiant($idEtud) {
        // Connexion à la base de données
        $bdd = Connexion::getConnexion();
    
        // Requête SQL pour supprimer un étudiant
        $sql = "DELETE FROM Etudiant WHERE idEtud = :idEtud";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':idEtud', $idEtud, PDO::PARAM_INT);
    
        // Exécuter la requête
        $stmt->execute();
    }

    public function listeEnseignant() {
        // Connexion à la base de données
        $bdd = Connexion::getConnexion();
    
        // Requête SQL pour récupérer les étudiants
        $sql = "SELECT idEns, nom, prenom, email FROM Enseignant";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
    
        // Tableau pour stocker les étudiants
        $enseignant = [];
    
        // Parcourir les résultats et les ajouter au tableau
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $enseignant[] = $row;
        }
    
        // Retourner le tableau des étudiants
        return $enseignant;
    }


}
