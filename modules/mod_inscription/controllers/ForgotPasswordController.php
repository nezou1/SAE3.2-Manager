<?php

class ForgotPasswordController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function showForm() {
        // Affiche le formulaire
        require '../views/forgot_password.php';
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';

            // Vérifie si l'email existe dans la base
            $user = $this->userModel->getUserByEmail($email);

            if (!$user) {
                echo "<p style='color:red; text-align:center;'>Adresse email introuvable.</p>";
                require '../views/forgot_password.php';
                return;
            }

            // Générer un lien de réinitialisation (simulé ici par une redirection)
            $resetToken = bin2hex(random_bytes(16));
            $this->userModel->saveResetToken($user['id'], $resetToken);

            // Simule l'envoi d'email (à remplacer par une vraie fonction d'envoi d'email)
            echo "<p style='color:green; text-align:center;'>Un email de réinitialisation a été envoyé à $email.</p>";
        } else {
            $this->showForm();
        }
    }
}
