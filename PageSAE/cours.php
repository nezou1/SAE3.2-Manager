<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours de la SAE</title>
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
        <h1>Cours de la SAE : Nom de la SAE</h1>
        <div class="description-container">
            <p class="description">Voici la liste des cours mis à votre disposition pour cette SAE. Vous pouvez les télécharger ci-dessous.</p>
        </div>
    </div>

    <div class="back-button-container">
        <a href="index.php" class="back-button">Retour à la page principale</a>
    </div>

    <div class="course-list">
        <div class="course-item">
            <h2>Cours 1: Introduction à la programmation</h2>
            <a href="uploads/cours_1.pdf" class="download-link" download>Télécharger le cours</a>
        </div>
        <div class="course-item">
            <h2>Cours 2: Algorithmes et structures de données</h2>
            <a href="uploads/cours_2.pdf" class="download-link" download>Télécharger le cours</a>
        </div>
        <div class="course-item">
            <h2>Cours 3: Bases de données</h2>
            <a href="uploads/cours_3.pdf" class="download-link" download>Télécharger le cours</a>
        </div>
    </div>

</body>
</html>
