<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAE Manager - <?=$module_title?></title>
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f4eb;
        }

        .navbar {
            background-color: #91A89B;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-link, .navbar .navbar-brand {
            color: white;
        }

        .container {
            margin-top: 30px;
        }

        .form-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #91A89B;
            border: none;
        }

        .btn-primary:hover {
            background-color: #778c7b;
        }

        .form-label {
            font-weight: bold;
        }
        .footer{
            background-color: #91A89B;
            color :white;
            padding: 30px;
            margin-top: 25px;
            text-align: center;
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
        <?=$module_html?>
    </main>
    <footer>
        <?php echo $footer->getAffichage();?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>