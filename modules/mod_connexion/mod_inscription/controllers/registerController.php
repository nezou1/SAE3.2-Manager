<?php

class RegisterController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function inscription() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $profil = $_POST['profil'] ?? 'etudiant';
            $activation_key = $_POST['activation_key'] ?? null;
            $password = 'defaultPassword123'; // Par défaut, tu peux modifier ça

            if (empty($nom) || empty($prenom) || empty($email)) {
                echo "Tous les champs doivent être remplis.";
                return;
            }

            if ($this->userModel->getUserByEmail($email)) {
                echo "Cet email est déjà utilisé.";
                return;
            }

            $this->userModel->inscrire($nom, $prenom, $email, $password, $profil, $activation_key);
            header('Location: /public/index.php?action=success');
            exit;
        }

        require '../views/register.php';
    }
}
