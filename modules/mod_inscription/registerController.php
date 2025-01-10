<?php

require "modele_inscription.php";
require "vue_inscription.php";
//require "modele_connexion.php";

class ControleurInscription {
    private $modele;
    private $vue;
    private $action;

    public function __construct() {
        $this->modele = new ModeleInscription();
        $this->vue = new VueInscription();
        $this->action = $_GET['action'] ?? 'inscrire';
    }

    public function exec() {

        switch ($this->action) {
            case 'confirme':
                $this->vue->confirmeInscription();
                break;
            case 'form':
                $this->vue->get_inscription();
                break;
            case 'inscrire':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->inscrire();
                } else {
                    $this->vue->get_inscription();
                }
                break;
            default:
                header('Location: ./index.php?module=inscription&action=form');
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
                $this->showInscriptionError("Cet email est déjà utilisé.");
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

    public function showInscriptionError($message) {
        $this->vue->formInscription(['form' => $message]);
    }
}