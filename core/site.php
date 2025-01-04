<?php

class Site {

	private $module;
	private $moduleNom;

    private $menu;

	public function __construct() {
		$this->moduleNom = isset($_GET['module']) ? $_GET['module'] : "inscription";

		switch ($this->moduleNom) {
			// case "etudiant" :
				//require_once "composants/menu/etudiant/composant_menu_etudiant.php";
			case "inscription" :                
				require_once "../modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
				break;
			// case "intervenant" :
                //require_once "composants/menu/intervenants/composant_menu_intervenant.php";
			case "connexion" :
				require_once "../modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
				break;
			// 	break;
			default :
				die ("Module inexistant");
		}
	}
	
	public function exec_module() {
		$module_class = "Mod".ucfirst($this->moduleNom);
		$this->module = new $module_class();
		$this->module->exec();
	}

	public function get_module() {
		return $this->module;
	}

    public function get_menu() {
        return $this->menu;
    }
}	
?>