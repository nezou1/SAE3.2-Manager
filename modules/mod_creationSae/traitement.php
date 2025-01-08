<?php
require_once('RessourceController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['ressources_file'])) {
        RessourceController::ajouterRessources($_FILES['ressources_file']);
        echo "Les ressources ont été ajoutées avec succès !";
    } else {
        echo "Aucun fichier sélectionné.";
    }
}
?>
