<?php

class ModuleSoutenance extends ModuleGenerique{

	private $controleur;

    public function __construct () {
		parent::__construct();
		$this->controleur = new ControleurSoutenance();
	}
}
?>