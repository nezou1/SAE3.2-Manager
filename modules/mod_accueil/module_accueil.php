<?php

require_once PROJECT_ROOT . "/modules/mod_accueil/controleur_accueil.php";

class ModAccueil extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Accueil";
		$this->controleur = new ControleurAccueil();
	}
}
?>