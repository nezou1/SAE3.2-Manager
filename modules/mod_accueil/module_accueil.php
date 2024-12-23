<?php

require_once "C:/wamp64/www/SAE3.2-Manager/modules/mod_accueil/controleur_accueil.php";

class ModAccueil extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Accueil";
		$this->controleur = new ControleurAccueil();
	}
}
?>