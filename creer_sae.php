<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_sae = $_POST['nom_sae'];
    $description = $_POST['description'];
    $date_depot = $_POST['date_depot'];
    $heure_depot = $_POST['heure_depot'];

    
    if (isset($_FILES['cours_file'])) {
        $cours_file = $_FILES['cours_file'];
      
    }

    if (isset($_FILES['ressources_file'])) {
        $ressources_file = $_FILES['ressources_file'];
        
    }

    
    echo "La SAE a été créée avec succès!";
}
?>
