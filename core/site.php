<?php

class Site {

	private $module;
	private $moduleNom;
	private $menuNom;

    private $menu;
	private $footer;

	public function __construct() {
		$this->menuNom = isset($_GET['menu']) ? $_GET['menu'] : "enseignant";
		$this->moduleNom = isset($_GET['module']) ? $_GET['module'] : "soutenance";

		switch($this->menuNom) {
			case "enseignant":
				require_once "C:/wamp64/www/SAE3.2-Manager/composants/menu/enseignants/composant_menu_enseignant.php";
				break;
			case "etudiant":
				require_once "C:/wamp64/www/SAE3.2-Manager/composants/menu/etudiants/composant_menu_etudiant.php";
				break;
			default:
				die("Profil inexistant");
		}
		$menu_class = "ComposantMenu".ucfirst($this->menuNom);
		$this->menu = new $menu_class();

		switch ($this->moduleNom) {
			case "accueil":
			case "sae":
			case "soutenance" :                
				require_once "C:/wamp64/www/SAE3.2-Manager/modules/mod_".$this->moduleNom."/module_".$this->moduleNom.".php";
				break;
			default :
				die ("Module inexistant");
		}
		$module_class = "Mod".ucfirst($this->moduleNom);
		$this->module = new $module_class();

		$this->footer = new ComposantFooter();
	}
	
	public function exec_module() {
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