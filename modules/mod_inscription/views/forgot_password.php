<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - SAE Manager</title>
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
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
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
            <form action="./index.php?action=forgot_password" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Votre adresse email" required>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="./index.php?action=login" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-secondary">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
