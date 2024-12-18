<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - SAE Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow p-4">
            <div class="text-center">
                <img src="../../../../assets/logo.png" alt="SAE Manager Logo" class="logo">
                <h2 class="mb-4">Inscription</h2>
            </div>
            <form action="/public/index.php?action=register" method="POST">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Adresse email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Adresse email" required>
                </div>
                  <!-- Profil et Clé d'activation alignés -->
                  <div class="row gx-2 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="profil" class="form-label">Profil</label>
                        <select id="profil" name="profil" class="form-select">
                            <option value="etudiant">Étudiant</option>
                            <option value="enseignant">Enseignant</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="activation_key" class="form-label">Clé d'activation</label>
                        <input id="activation_key" type="text" name="activation_key" class="form-control" placeholder="Clé d'activation">
                    </div>
                </div>
                <!-- Bouton S'inscrire -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-secondary">S'inscrire</button>
                </div>
                <!-- Lien Connexion -->
                <div class="text-center mt-3">
                    <a href="index.html" class="text-decoration-none text-primary">Vous avez déjà un compte ? Connectez-vous !</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
