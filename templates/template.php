<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - SAE Manager</title>
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #F7F1E9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
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
    </style> -->
</head>
<body>
    <div class="container">
        <div class="card shadow p-4">
            <section>
                <nav>
<?php               echo $menu->getAffichage();?>
                </nav>
            </section>

            <main>
                <?=$module_html?>
            </main>

            <footer>
                <?php echo $footer->getAffichage();?>
            </footer>
</body>
