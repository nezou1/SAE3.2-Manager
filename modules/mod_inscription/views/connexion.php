<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - SAE Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F7F1E9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
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
        .btn-primary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow p-4">
            <div class="text-center">
                <img src="/SAE3.2-Manager/assets/logo.png" alt="SAE Manager Logo" class="logo">
            </div>
            <form action="./index.php?action=login" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Identifiant</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Identifiant" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Connexion</button>
                </div>
                <div class="text-center mt-3">
                    <a href="/public/index.php?action=register" class="text-decoration-none text-primary">Vous n’avez pas de compte ? Inscrivez-vous !</a><br>
                    <a href="/public/index.php?action=forgot_password" class="text-decoration-none text-primary">Mot de passe oublié ?</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
