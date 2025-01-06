<?php

require_once PROJECT_ROOT . "/modules/mod_accueil/modele_accueil.php";
require_once PROJECT_ROOT . "/modules/mod_accueil/vue_accueil.php";

class ControleurAccueil {

	private $action;
    private $modele;
    private $vue;

    public function __construct() {
		$this->modele = new ModeleAccueil();
		$this->vue = new VueAccueil();
	}

    public function exec() {
		$this->action = isset($_GET["action"]) ? $_GET["action"] : "liste";
		
		switch ($this->action) {
			case "liste" :
				$this->get_soutenances();
				break;
			case "form_ajout" :
				$this->form_ajout();
				break;
			case "ajout" :
				if(isset($_POST["tokenCSRF"]) && $_POST["tokenCSRF"] == $_SESSION['token']){
					$this->ajout();
				} else {
					die("token incorrecte");
				}
				break;
			default : 
				die ("Action inexistante");
			
		}
	}
}
?>