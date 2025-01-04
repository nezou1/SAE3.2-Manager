<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ressources de la SAE</title>
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
        <h1>Ressources de la SAE : Nom de la SAE</h1>
        <p class="description">Voici la liste des ressources mises à votre disposition pour cette SAE. Vous pouvez les télécharger ci-dessous.</p>
    </div>

    <div class="back-button-container">
        <a href="index.php" class="back-button">Retour à la page principale</a>
    </div>

    <div class="resource-list">
        <div class="resource-item">
            <h2>Ressource 1: Document sur l'algorithmique</h2>
            <a href="uploads/ressource_1.pdf" class="download-link" download>Télécharger la ressource</a>
        </div>
        <div class="resource-item">
            <h2>Ressource 2: Introduction aux bases de données</h2>
            <a href="uploads/ressource_2.pdf" class="download-link" download>Télécharger la ressource</a>
        </div>
        <div class="resource-item">
            <h2>Ressource 3: Concepts avancés de programmation</h2>
            <a href="uploads/ressource_3.pdf" class="download-link" download>Télécharger la ressource</a>
        </div>
    </div>
</body>
</html>
