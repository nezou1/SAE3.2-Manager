<?php

require_once 'modele_connexion.php';
require_once 'vue_connexion.php';
require_once PROJECT_ROOT . '/modules/mod_dashboard/vue_dashboard.php';

class ControleurConnexion {
    private $modele;
    private $vue;
    private $action;
    private $dashboard;

    public function __construct() {
        $this->modele = new ModeleConnexion();
        $this->vue = new VueConnexion();
        $this->action = $_GET['action'] ?? 'login';
        $this->dashboard = new VueDashboard();
    }

    public function exec() {
        switch ($this->action) {
            case 'login':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->modele->login();
                } else {
                    $this->vue->get_connexion(); // Affiche le formulaire si aucune soumission
                }
                break;
            case 'logout':
                $this->logout();
                break;
            case 'success':
                $this->vue->loginSuccess(); // Affiche un message de succès
            default:
                $this->vue->get_connexion(); // Affiche le formulaire par défaut
                break;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ./index.php/?module=connexion&action=logout');
        exit();
    }


}
?>