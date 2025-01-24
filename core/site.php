<?php

class Site {

	private $module;
	private $moduleNom;

    private $menu;
	private $menuNom;
	private $footer;

	public function __construct() {
		$this->moduleNom = isset($_GET['module']) ? $_GET['module'] : "connexion";
		$this->menuNom = isset($_GET['menu']) ? $_GET['menu'] : "connexion";

		switch($this->menuNom) {
			case "enseignant":
			case "etudiant":
				require_once  "../composants/menu/".$this->menuNom."s/composant_menu_".$this->menuNom.".php";
				break;
			case "connexion":
				require_once  "../composants/menu/".$this->menuNom."/composant_menu_".$this->menuNom.".php";
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
			case "liste":     
			case "groupeEtudiant":    
			case "gestionnaireRessource":
			case "groupe":  
			case "evaluation":   
				require_once "../modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
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