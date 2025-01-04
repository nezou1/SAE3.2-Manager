<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépôt de travail - SAE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar">
        <div class="navbar-left">
            <img src="profile-icon.png" alt="Profile Icon" class="profile-icon">
        </div>
        <div class="navbar-center">
            <nav>
                <a href="index.php">Mes SAE</a>
                <a href="#">Trello</a>
                <a href="#">Github</a>
                <a href="#">Déconnexion</a>
            </nav>
        </div>
        <div class="navbar-right">
            <input type="text" placeholder="Search" class="search-input">
            <img src="bell-icon.png" alt="Notifications" class="icon">
            <img src="message-icon.png" alt="Messages" class="icon">
        </div>
    </header>

    <div class="hero">
        <h1>Dépôt de travail pour la SAE : Nom de la SAE</h1>
        <p class="description">Vous pouvez déposer votre travail en téléchargeant le fichier ci-dessous.</p>
    </div>

    <div class="back-button-container">
        <a href="index.php" class="back-button">Retour à la page principale</a>
    </div>

    <div class="upload-form-container">
        <h2>Déposer votre travail</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data" class="upload-form">
            <label for="file-upload" class="upload-label">Choisir un fichier à télécharger</label>
            <input type="file" name="file-upload" id="file-upload" class="upload-input" required>
            <button type="submit" class="upload-button">Envoyer le fichier</button>
        </form>
    </div>
</body>
</html>
