<?php

require_once "registerController.php";

class ModInscription extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Inscription";
		$this->controleur = new ControleurInscription();
	}
}
?>