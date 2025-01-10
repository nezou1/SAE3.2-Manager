<?php

class Site {

	private $module;
	private $moduleNom;

    private $menu;
	private $menuNom;
	private $footer;

	public function __construct() {
		$this->moduleNom = isset($_GET['module']) ? $_GET['module'] : "inscription";
		$this->menuNom = isset($_GET['menu']) ? $_GET['menu'] : "connexion";

		switch($this->menuNom) {
			case "enseignant":
			case "etudiant":
				require_once PROJECT_ROOT . "composants/menu/".$this->menuNom."s/composant_menu_".$this->menuNom.".php";
				break;
			case "connexion":
				require_once PROJECT_ROOT . "composants/menu/".$this->menuNom."/composant_menu_".$this->menuNom.".php";
				break;
			default :
				die ("Menu inexistant");
				break;
			
		}
		$menu_class = "ComposantMenu".ucfirst($this->menuNom);
		$this->menu = new $menu_class();

		switch ($this->moduleNom) {
			case "inscription" :  
			case "connexion" :
			case "mdpOublie" :
			case "dashboard" :	
			case "sae":
			case "soutenance" :
			case "depot":                
				require_once PROJECT_ROOT . "/modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
				break;
			default :
				die ("Module inexistant");
		}
	}
	
	
	public function exec_module() {
		$module_class = "Mod".ucfirst($this->moduleNom);
		$this->module = new $module_class();
		$this->footer = new ComposantFooter();
		$this->module->exec();
	}

	public function get_module() {
		return $this->module;
	}

    public function get_menu() {
        return $this->menu;
    }

	public function get_footer() {
        return $this->footer;
    }
}	
?>