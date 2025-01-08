<?php
require_once('SaeModel.php');

class CreerSaeController {
    public static function createSae($titre, $description, $annee, $semestre, $cours_file, $ressources_file, $heure_depot) {
        try {
            SaeModel::insertSae($titre, $description, $annee, $semestre, $cours_file, $ressources_file, $heure_depot);
            echo "SAE ajoutée avec succès !";
        } catch (Exception $e) {
            die('Erreur lors de la création de la SAE : ' . $e->getMessage());
        }
    }
}
?>
