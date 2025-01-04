<?php

require_once "loginController.php";

class ModConnexion extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Connexion";
		$this->controleur = new ControleurConnexion();
	}
}
?>