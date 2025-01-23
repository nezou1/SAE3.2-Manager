<?php

require_once "listController.php";

class ModListe extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "liste";
		$this->controleur = new ControleurListe();
	}
}
?>