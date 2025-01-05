<?php

require_once 'modele_connexion.php';
require_once 'vue_connexion.php';

class ControleurConnexion {
    private $modele;
    private $vue;
    private $action;

    public function __construct() {
        $this->modele = new ModeleConnexion();
        $this->vue = new VueConnexion();
        $this->action = $_GET['action'] ?? 'login';
    }

    public function exec() {
        switch ($this->action) {
            case 'login':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->vue->get_connexion();
                } else {
                    $this->vue->get_connexion();
                }
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                $this->vue->get_connexion(); // Affiche le formulaire par défaut
                break;
        }
    }


}
?>