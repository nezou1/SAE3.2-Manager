<?php
/*require "modele_inscription.php";
require "vue_inscription.php";

class ControleurInscription {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleInscription();
        $this->vue = new VueInscription();
    }

    public function exec() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'form';

        switch ($action) {
            case 'confirme':
                $this->vue->confirmeInscription();
                break;
            case 'form':
                $this->vue->get_inscription();
                break;
            case 'inscrire':
                $this->inscrire();
                break;
            default:
                header('Location: ./index.php?module=mod_inscription&action=form');
                exit;
            
        }
    }

    private function getInscription() {
        $activation_key = $_GET['activation_key'] ?? null;

        if ($activation_key) {
            $user = $this->modele->getUserByActivationKey($activation_key);

            if ($user) {
                $this->modele->activerUser($user['id']);
                $this->vue->confirmeActivation();
            } else {
                $this->vue->erreurActivation();
            }
        } 
    }

    private function inscrire() {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $profil = $_POST['profil'] ?? 'etudiant';
        $activation_key = $_POST['activation_key'] ?? null;

        $errors = [];

        if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
            $errors['form'] = "Tous les champs doivent être remplis.";
            $this->vue->formInscription($errors);
            return;
        }

        if ($this->modele->getUserByEmail($email)) {
            $errors['email'] = "Cet email est déjà utilisé.";
            $this->vue->formInscription($errors);
            return;
        }

        $this->modele->inscrire($nom, $prenom, $email, $password, $profil, $activation_key);
        $this->vue->confirmeInscription();
    }
}*/

require "modele_inscription.php";
require "vue_inscription.php";

class ControleurInscription {
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleInscription();
        $this->vue = new VueInscription();
    }

    public function exec() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'inscrire';

        switch ($action) {
            case 'confirme':
                $this->vue->confirmeInscription();
                break;
            case 'form':
                $this->vue->get_inscription();
                break;
            case 'inscrire':
                $this->inscrire();
                break;
            default:
                header('Location: ./index.php?module=mod_inscription&action=form');
                exit;
        }
    }

    private function inscrire() {
        try {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $profil = trim($_POST['profil'] ?? 'etudiant');
            $activation_key = $_POST['activation_key'] ?? null;

            $errors = [];

            if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
                $errors['form'] = "Tous les champs doivent être remplis.";
                $this->vue->formInscription($errors);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'adresse email est invalide.";
                $this->vue->formInscription($errors);
                return;
            }

            if ($this->modele->getUserByEmail($email)) {
                $errors['email'] = "Cet email est déjà utilisé.";
                $this->vue->formInscription($errors);
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $this->modele->inscrire($nom, $prenom, $email, $hashedPassword, $profil, $activation_key);
            $this->vue->confirmeInscription();
        } catch (Exception $e) {
            error_log("Erreur lors de l'inscription : " . $e->getMessage());
            $this->vue->formInscription(['db_error' => "Une erreur est survenue. Veuillez réessayer plus tard."]);
        }
    }
}