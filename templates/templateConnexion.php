<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$module_title?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="./assets/css/styleCalendrier.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F7F1E9;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
        }
        .navbar {
            background-color: #91A89B;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-link, .navbar .navbar-brand {
            color: white;
            border-radius: 5px;
            padding-left: 5px;
        }

        .navbar .nav-link:hover, .navbar .navbar-brand:hover {
            background-color: #778c7b;
            transition-duration: 0.4s;
            border-radius: 5px;
        }
        .logo {
            width: 150px;
            margin: 0 auto 20px;
        }
        button {
            background-color: #6c757d;
            color: white;
        }
        button:hover {
            background-color: #5a6268;
        }

        .btn {
            background-color: #E6E6E6;
            border: solid 1px #767676;
        }

        .connexion {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        </style>
    </head>
    <body> 
        <header>
            <nav class="navbar navbar-expand-lg">
                <?php echo $menu->getAffichage();?>
            </nav>
        </header>
        <main class="connexion">
            <?= $module_html ?>
        </main>     
        <footer>
            <?php echo $footer->getAffichage();?>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
