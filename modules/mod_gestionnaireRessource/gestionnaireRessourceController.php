<?php

require_once 'modele_gestionnaireRessource.php';
require_once 'vue_gestionnaireRessource.php';

class ControleurgestionnaireRessource {
    private $modele;
    private $vue;
    private $action;
    private $menu;

    public function __construct() {
        $this->modele = new ModelegestionnaireRessource();
        $this->vue = new VueGestionnaireRessource();
        $this->action = $_GET['action'] ?? 'exec';
        $this->menu = $_GET['menu'] ?? 'enseignant';
    }

    public function exec() {

        switch ($this->action) {
            case 'exec':
                $result = $this->modele->listeRessource();
                $this->vue->afficherRessources($result);
                break;
            case 'logout':
                $this->logout();
                break;
            default:
            $this->vue->get_gestionnaireRessource();
                break;
        }
    }


}
?>