<?php

class Site {

	private $module;
	private $moduleNom;

    private $menu;
	private $menuNom;

	public function __construct() {
		$this->moduleNom = isset($_GET['module']) ? $_GET['module'] : "inscription";
		$this->menuNom = isset($_GET['menu']) ? $_GET['menu'] : "etudiant";

		switch($this->menuNom) {
			case "enseignant":
				require_once PROJECT_ROOT . "/composants/menu/enseignants/composant_menu_enseignant.php";
				break;
			case "etudiant":
				require_once PROJECT_ROOT . "/composants/menu/etudiants/composant_menu_etudiant.php";
				break;
			case "connexion":
				require_once "../composants/menu/connexion/composant_menu_connexion.php";
		}
		$menu_class = "ComposantMenu".ucfirst($this->menuNom);
		$this->menu = new $menu_class();
	


		switch ($this->moduleNom) {
		
			case "inscription" :  
				require_once "../modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
				break;
			case "connexion" :
				require_once "../modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
				break;
			case "mdpOublie" :
				require_once "../modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
				break;
			case "dashboard" :	
				require_once "../modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
				break;
			case "accueil":
				case "sae":
				case "soutenance" :                
					require_once PROJECT_ROOT . "/modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
					break;
				default :
					die ("Module inexistant");
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

	public function get_footer() {
        return $this->footer;
    }
}	
?>