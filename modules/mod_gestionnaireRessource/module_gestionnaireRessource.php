<?php

require_once "gestionnaireRessourceController.php";

class ModGestionnaireRessource extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Gestionnaire Ressource";
		$this->controleur = new ControleurGestionnaireRessource();
	}
}
?>