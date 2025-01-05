<?php

require "modele_mdpOublie.php";
require "vue_mdpOublie.php";
require "/Users/nezhaelfayez/Desktop/IUT/S3/PHP/local_html/SAE3.2-Manager/modules/mod_inscription/modele_inscription.php";

class ControleurMdpOublie {
    private $modele;
    private $vue;
    private $action;
    private $userModel;

    public function __construct() {
        $this->modele = new ModeleMdpOublie();
        $this->vue = new VueMotDePasseOublie();
        $this->userModel = new ModeleInscription();
        $this->action = $_GET['action'] ?? 'mdpOublie';
    }

    public function exec() {

        switch ($this->action) {
            case 'mdpOublie':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->handleRequest();
                } else {
                    $this->vue->get_mdpOublie();
                }
                break;
            case 'messageEnvoye':
                $this->handleRequest();
                break;
            default:
                $this->vue->formMotDePasseOublie();
                exit;
        }
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';

            // Vérifie si l'email existe dans la base
            $user = $this->userModel->getUserByEmail($email);

            if (!$user) {
                echo "<p style='color:red; text-align:center;'>Adresse email introuvable.</p>";
                require 'vue_mdpOublie.php';
                return;
            }

            // Générer un lien de réinitialisation (simulé ici par une redirection)
            // Simule l'envoi d'email (à remplacer par une vraie fonction d'envoi d'email)
            echo "<p style='color:green; text-align:center;'>Un email de réinitialisation a été envoyé à $email.</p> <br>";
            echo "<a href='./index.php?module=connexion&action=login'>Retourner à la connexion</a> <br>";
            header("Refresh: 5; URL=./index.php?module=connexion&action=login");
        } else {
            $this->vue->formMotDePasseOublie();
        }
    }
}
