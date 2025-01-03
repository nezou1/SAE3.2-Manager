<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Vérifier si c'est une recherche

    if (isset($_POST['search'])) {

        $search = htmlspecialchars($_POST['search']);

        echo "Vous avez recherché : " . $search;

    }



    // Vérifier si c'est un email

    if (isset($_POST['email'])) {

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

        if ($email) {

            echo "Merci pour votre inscription : " . $email;

        } else {

            echo "Email invalide. Veuillez réessayer.";

        }

    }

}

?>