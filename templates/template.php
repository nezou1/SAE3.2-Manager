<!DOCTYPE html>
<html lang="fr">
    <head>
    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SAE Manager - <?=$module_title?></title>
        <!-- Lien vers Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        Bootstrap Select CSS -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="assets/css/navbar.css">


    <style>
    /* Couleurs principales */
    :root {
        --main-bg-color: #91A89B; /* Vert doux */
        --hover-bg-color: #778c7b; /* Vert foncé */
        --light-bg-color: #f8f4eb; /* Beige clair */
    }

    /* Style général */
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: var(--light-bg-color);
    }

    /* Barre de navigation */
    .navbar {
        background-color: var(--main-bg-color);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 10px 20px;
    }

    .navbar .nav-link, .navbar .navbar-brand {
        color: white;
        font-weight: bold;
        margin-right: 15px;
        text-transform: uppercase;
        font-size: 14px;
    }

    .navbar .nav-link:hover, .navbar .navbar-brand:hover {
        background-color: var(--hover-bg-color);
        transition: background-color 0.3s;
        border-radius: 5px;
    }

    /* Recherche */
    .form-control {
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    /* Icônes */
    .navbar img {
        cursor: pointer;
        transition: transform 0.2s ease-in-out;
    }

    .navbar img:hover {
        transform: scale(1.1);
    }

    /* Pied de page */
    footer {
        background-color: var(--main-bg-color);
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: 30px;
    }

    footer a {
        color: white;
        text-decoration: none;
    }

    footer a:hover {
        text-decoration: underline;
    }
</style>


    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg">
                <?php echo $menu->getAffichage();?>
            </nav>
        </header>
        <main>
            <section>
                <?=$module_html?>
            </section>
        </main>
        <footer>
            <?php echo $footer->getAffichage();?>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap JS -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        Bootstrap Select JS -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select/dist/js/bootstrap-select.min.js"></script> -->

    </body>
</html>