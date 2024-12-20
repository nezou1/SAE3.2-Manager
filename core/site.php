<?php

class Site {

	private $module;
	private $moduleNom;

    private $menu;

	public function __construct() {
		$this->moduleNom = isset($_GET['module']) ? $_GET['module'] : "responsable";

		switch ($this->moduleNom) {
			case "etudiant" :
				//require_once "composants/menu/composant_menu_etudiant.php";
			case "responsable" :
				require_once "composants/menu/composant_menu_responsable.php";
                $menu = new ComposantMenuResponsable();
			case "intervenant" :
                //require_once "composants/menu/composant_menu_intervenant.php";
			case "connexion" :
				require_once "modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
				break;
			default :
				die ("Module inexistant");
		}
	}
	
	public function exec_module() {
		$module_class = "Mod".$this->moduleNom;
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