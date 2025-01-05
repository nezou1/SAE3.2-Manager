<?php

require_once 'modele_dashboard.php';
require_once 'vue_dashboard.php';

class ControleurDashboard {
    private $modele;
    private $vue;
    private $action;

    public function __construct() {
        $this->modele = new ModeleDashboard();
        $this->vue = new VueDashboard();
        $this->action = $_GET['action'] ?? 'exec';
    }

    public function exec() {
        switch ($this->action) {
            case 'exec':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->modele->get_dashboard();
                    $this->vue->get_dashboard();
                } else {
                    $this->vue->get_dashboard();
                }
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                $this->vue->get_dashboard(); // Affiche le formulaire par défaut
                break;
        }
    }


}
?>