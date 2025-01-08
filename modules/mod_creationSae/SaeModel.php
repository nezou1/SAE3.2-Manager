<?php
require_once('Database.php');

class SaeModel {
    public static function insertSae($titre, $description, $annee, $semestre, $cours_file, $ressources_file, $heure_depot) {
        try {
            $bdd = Database::getConnexion();

            if ($bdd === null) {
                throw new Exception('Connexion à la base de données non initialisée.');
            }

            $query = $bdd->prepare('INSERT INTO sae_table (titre, description, annee, semestre, cours_file, ressources_file, heure_depot)
                                    VALUES (:titre, :description, :annee, :semestre, :cours_file, :ressources_file, :heure_depot)');
            $query->execute([
                ':titre' => $titre,
                ':description' => $description,
                ':annee' => $annee,
                ':semestre' => $semestre,
                ':cours_file' => $cours_file,
                ':ressources_file' => $ressources_file,
                ':heure_depot' => $heure_depot
            ]);
        } catch (Exception $e) {
            die('Erreur lors de l\'insertion : ' . $e->getMessage());
        }
    }
}
?>
