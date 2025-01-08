<?php

require_once "groupeController.php";

class ModGroupe extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Groupe";
		$this->controleur = new ControleurGroupe();
	}
}
?>