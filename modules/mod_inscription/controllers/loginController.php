<?php

class loginController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Vérifier si l'utilisateur existe
            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Connexion réussie
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                header('Location: ./index.php?action=dashboard');
                exit;
            } else {
                echo "<p style='color:red; text-align:center;'>Identifiant ou mot de passe incorrect.</p>";
            }
        }

        // Charger la vue de connexion
        require '../views/connexion.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /public/index.php?action=login');
        exit;
    }
}
