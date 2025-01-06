<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une SAE</title>
    <link rel="stylesheet" href="creer_sae.css">
</head>
<body>
    <header class="navbar">
        <div class="navbar-left">
            <img src="profile-icon.png" alt="Profile Icon" class="profile-icon">
        </div>
        <div class="navbar-center">
            <nav>
                <a href="#">Mes SAE</a>
                <a href="#">Créer une SAE</a>
                <a href="#">Planning</a>
                <a href="#">Lien</a>
            </nav>
        </div>
        <div class="navbar-right">
            <input type="text" placeholder="Search" class="search-input">
            <img src="bell-icon.png" alt="Notifications" class="icon">
            <img src="message-icon.png" alt="Messages" class="icon">
        </div>
    </header>

    <div class="form-container">
        <h1>Créer une SAE</h1>
        
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <label for="titre" class="form-label">Titre de la SAE</label>
            <input type="text" id="titre" name="titre" class="form-input" placeholder="Titre du projet" required>

            <label for="description" class="form-label">Courte Description</label>
            <input type="text" id="description" name="description" class="form-input" placeholder="Description du projet" required>

            <label for="annee" class="form-label">Année</label>
            <input type="date" id="annee" name="annee" class="form-input" required>

            <label for="semestre" class="form-label">Semestre</label>
            <input type="number" id="semestre" name="semestre" class="form-input" placeholder="1" required>

            <label for="heure_depot" class="form-label">Heure de dépôt</label>
            <input type="time" id="heure_depot" name="heure_depot" class="form-input" required>

            <div class="file-upload-container">
                <div class="file-upload">
                    <input type="file" name="cours_file" id="cours_file">
                    <label for="cours_file" class="file-label">Joindre le cours</label>
                </div>
                <div class="file-upload">
                    <input type="file" name="ressources_file" id="ressources_file">
                    <label for="ressources_file" class="file-label">Joindre les ressources</label>
                </div>
            </div>

            <button type="submit" class="submit-button">Ajouter</button>
        </form>
    </div>
</body>
</html>
