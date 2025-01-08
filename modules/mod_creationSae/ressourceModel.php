<?php
require_once('Database.php');

class RessourceModel {
    public static function insertRessources($ressources) {
        try {
            $bdd = Database::getConnexion();

            $query = $bdd->prepare('INSERT INTO ressources (nom_fichier) VALUES (:nom_fichier)');
            foreach ($ressources as $fichier) {
                $query->execute([':nom_fichier' => $fichier]);
            }
        } catch (Exception $e) {
            die('Erreur lors de l\'insertion des ressources : ' . $e->getMessage());
        }
    }
}
?>
