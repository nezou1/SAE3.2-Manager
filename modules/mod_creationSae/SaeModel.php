<?php
require_once 'database.php';

class SaeModel {

    
    public function insertSae($titre, $description, $annee, $semestre, $cours_file, $ressources_file, $heure_depot) {
        global $pdo;

       
        $sql = "INSERT INTO Projet (titre, description, annee, semestre, cours_file, ressources_file, heure_depot) 
                VALUES (:titre, :description, :annee, :semestre, :cours_file, :ressources_file, :heure_depot)";
        
        $stmt = $pdo->prepare($sql);
        
       
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':annee', $annee);
        $stmt->bindParam(':semestre', $semestre);
        $stmt->bindParam(':cours_file', $cours_file);
        $stmt->bindParam(':ressources_file', $ressources_file);
        $stmt->bindParam(':heure_depot', $heure_depot);
        
        return $stmt->execute();
    }
}
?>
