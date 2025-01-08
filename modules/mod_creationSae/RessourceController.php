<?php
require_once('RessourceModel.php');

class RessourceController {
    public static function ajouterRessources($files) {
        $ressources = [];
        foreach ($files['name'] as $key => $name) {
            $tmp_name = $files['tmp_name'][$key];
            $destination = 'uploads/' . basename($name);

            if (move_uploaded_file($tmp_name, $destination)) {
                $ressources[] = $name; // On enregistre le nom du fichier
            } else {
                die('Erreur lors de l\'upload du fichier : ' . $name);
            }
        }

        // Enregistre les ressources en base de données
        RessourceModel::insertRessources($ressources);
    }
}
?>
