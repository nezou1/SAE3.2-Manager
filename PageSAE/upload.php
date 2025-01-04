<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] == 0) {
        $fileTmpPath = $_FILES['file-upload']['tmp_name'];
        $fileName = $_FILES['file-upload']['name'];
        $fileSize = $_FILES['file-upload']['size'];
        $fileType = $_FILES['file-upload']['type'];

        $uploadDirectory = 'uploads/';
        
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $destination = $uploadDirectory . basename($fileName);

        if (move_uploaded_file($fileTmpPath, $destination)) {
            echo "Le fichier a été téléchargé avec succès!";
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
    } else {
        echo "Aucun fichier n'a été téléchargé ou une erreur est survenue.";
    }
}
?>
