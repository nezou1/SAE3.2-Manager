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
        <link rel="stylesheet" href="../assets/css/body.css">
        <link rel="stylesheet" href="../assets/css/navbar.css">
        <link rel="stylesheet" href="../assets/css/form.css">
        <link rel="stylesheet" href="../assets/css/footer.css">
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
    </body>
</html>