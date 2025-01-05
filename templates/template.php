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
                border-radius: 5px;
                padding-left: 5px;
            }

            .navbar .nav-link:hover, .navbar .navbar-brand:hover {
                background-color: #778c7b;
                transition-duration: 0.4s;
                border-radius: 5px;
            }

            .container {
                margin-top: 30px;
                height: 
            }

            .form-container {
                background-color: white;
                border-radius: 10px;
                padding: 20px;
                height: 100% 
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .table-container {
                background-color: white;
                border-radius: 10px;
                padding: 20px;
                height: 100% 
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

            
            .container {
                max-width: 400px;
            }
            .logo {
                width: 150px;
                margin: 0 auto 20px;
            }
            .btn-primary {
                background-color: #6c757d;
                color: white;
            }
            button {
            background-color: #6c757d;
            color: white;
            }
            button:hover {
                background-color: #5a6268;
            }
            .btn-primary:hover {
                background-color: #5a6268;
            }
            .error-message {
                color: red;
                font-size: 0.9em;
            }

            footer{
                background-color: #91A89B;
                display: block;
                color :white;
                padding: 30px;
                margin-top: 25px;
                box-sizing: border-box;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg">
                <?php 
                if (isset($_SESSION['profil'])) {
                    // Affichage selon le profil
                    if ($_SESSION['profil'] === 'enseignant') {
                        include('../composants/menu/enseignants/composant_menu_enseignant.php');
                        $menu = new ComposantMenuEnseignant();
                        echo $menu->getAffichage();
                    } else {
                        include('../composants/menu/etudiants/composant_menu_etudiant.php');
                        $menu = new ComposantMenuEtudiant();
                        echo $menu->getAffichage();
                    }
                } else {
                    include('../composants/menu/etudiants/composant_menu_etudiant.php');
                        $menu = new ComposantMenuEtudiant();
                        echo $menu->getAffichage();
                    //echo "<p class='text-center text-white'>Erreur : aucun profil détecté.</p>";
                }
                ?>
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
    </body>
</html>