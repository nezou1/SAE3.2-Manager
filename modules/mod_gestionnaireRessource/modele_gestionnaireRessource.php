<?php

require_once(PROJECT_ROOT .'/core/connexion.php');
class ModelegestionnaireRessource extends Connexion {

    public function listeRessource() {
        // Connexion à la base de données
        $bdd = Connexion::getConnexion();
    
        // Requête SQL pour récupérer les ressources
        $sql = "SELECT idRessource, titre, type, url, mise_en_avant, idProjet FROM Ressource";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
    
        // Tableau pour stocker les ressources
        $ressources = [];
    
        // Parcourir les résultats et les ajouter au tableau
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ressources[] = $row;
        }
    
        // Retourner le tableau des ressources
        return $ressources;
    }

    public function supprimerRessource($idRessource) {
        // Connexion à la base de données
        $bdd = Connexion::getConnexion();
    
        // Requête SQL pour supprimer une ressource
        $sql = "DELETE FROM Ressource WHERE idRessource = :idRessource";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':idRessource', $idRessource, PDO::PARAM_INT);
    
        // Exécuter la requête
        $stmt->execute();
    }


}
