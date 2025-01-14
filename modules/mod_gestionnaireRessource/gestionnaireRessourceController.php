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
        $this->vue = new VuegestionnaireRessource();
        $this->action = $_GET['action'] ?? 'exec';
        $this->menu = $_GET['menu'] ?? 'enseignant';
    }

    public function exec() {

        switch($this->menu){
            case "enseignant":
                require_once PROJECT_ROOT . "/composants/menu/enseignants/composant_menu_enseignant.php";
                break;
            default:
                require_once "../composants/menu/connexion/composant_menu_connexion.php";
        }
        switch ($this->action) {
            case 'exec':
                $this->modele->affichergestionnaireRessource();
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