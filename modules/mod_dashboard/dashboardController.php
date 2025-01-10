<?php

require_once 'modele_dashboard.php';
require_once 'vue_dashboard.php';

class ControleurDashboard {
    private $modele;
    private $vue;
    private $action;
    private $menu;

    public function __construct() {
        $this->modele = new ModeleDashboard();
        $this->vue = new VueDashboard();
        $this->action = $_GET['action'] ?? 'exec';
        $this->menu = $_GET['menu'] ?? 'dashboard';
    }

    public function exec() {

        switch($this->menu){
            case "enseignant":
                require_once PROJECT_ROOT . "/composants/menu/enseignants/composant_menu_enseignant.php";
                break;
            case "etudiant":
                require_once PROJECT_ROOT . "/composants/menu/etudiants/composant_menu_etudiant.php";
                break;
            case "connexion":
                require_once "../composants/menu/connexion/composant_menu_connexion.php";
                break;
            default:
                require_once "../composants/menu/connexion/composant_menu_connexion.php";
        }
        switch ($this->action) {
            case 'exec':
                $this->modele->afficherDashboard();
                break;
            case 'logout':
                $this->logout();
                break;
            default:
            $this->vue->get_dashboard();
                break;
        }
    }


}
?>