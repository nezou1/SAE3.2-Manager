<?php
require_once 'SaeModel.php';

class CreerSaeController {

    public function createSae() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $annee = $_POST['annee'];
            $semestre = $_POST['semestre'];
            $heure_depot = $_POST['heure_depot']; 

            $cours_file = $_FILES['cours_file']['name'];
            $ressources_file = $_FILES['ressources_file']['name'];

            $uploadDirectory = 'uploads/';

            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0777, true);
            }

            move_uploaded_file($_FILES['cours_file']['tmp_name'], $uploadDirectory . $cours_file);
            move_uploaded_file($_FILES['ressources_file']['tmp_name'], $uploadDirectory . $ressources_file);

            $model = new SaeModel();
            $model->insertSae($titre, $description, $annee, $semestre, $cours_file, $ressources_file, $heure_depot);
            
            header('Location: success.php');
            exit();
        }

        require_once 'creer_sae_view.php';
    }
}
?>
