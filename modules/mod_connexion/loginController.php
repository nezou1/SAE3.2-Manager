<?php

/*require_once 'modele_connexion.php';
require_once 'vue_connexion.php';

class ControleurConnexion {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleConnexion();
        $this->vue = new VueConnexion();
    }

    public function exec() {
        $action = $_GET['action'] ?? 'login';

        switch ($action) {
            case 'login':
                $this->vue->get_connexion();
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                $this->vue->get_connexion(); // Affiche le formulaire par défaut
                break;
        }
    }

    private function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Vérifier si l'utilisateur existe
            $user = $this->modele->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Connexion réussie
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                header('Location: ./index.php?action=dashboard');
                exit;
            } else {
                $this->vue->showLoginForm("Identifiant ou mot de passe incorrect.");
            }
        } else {
            $this->vue-> formConnexion(); // Afficher le formulaire si aucune requête POST
        }
    }

    private function logout() {
        session_start();
        session_destroy();
        header('Location: ./index.php?action=login');
        exit;
    }
}*/

require_once 'modele_connexion.php';
require_once 'vue_connexion.php';

class ControleurConnexion {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleConnexion();
        $this->vue = new VueConnexion();
    }

    public function exec() {
        $action = $_GET['action'] ?? 'login';

        switch ($action) {
            case 'login':
                $this->login(); // Ajout de l'appel explicite de la fonction login
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                $this->vue->get_connexion(); // Affiche le formulaire par défaut
                break;
        }
    }

    private function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            try {
                $user = $this->modele->getUserByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['nom'];
                    header('Location: ./index.php?action=dashboard');
                    exit;
                } else {
                    $this->vue->showLoginForm("Identifiant ou mot de passe incorrect.");
                }
            } catch (Exception $e) {
                error_log("Erreur lors de la connexion : " . $e->getMessage());
                $this->vue->showLoginForm("Une erreur est survenue. Veuillez réessayer plus tard.");
            }
        } else {
            $this->vue->formConnexion(); // Affiche le formulaire de connexion
        }
    }

    private function logout() {
        session_start();
        session_destroy();
        header('Location: ./index.php?action=login');
        exit;
    }   
}
?>