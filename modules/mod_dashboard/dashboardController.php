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
                $this->modele->afficherDashboard();
                $this->vue->get_dashboard($_SESSION['role'], $_SESSION['prenom'], $_SESSION['nom']);
                break;
            case 'logout':
                $this->logout();
                break;
            default:
            $this->vue->get_dashboard($_SESSION['role'], $_SESSION['prenom'], $_SESSION['nom']);
                break;
        }
    }


}
?>