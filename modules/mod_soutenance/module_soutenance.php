<?php

require_once PROJECT_ROOT . "/modules/mod_soutenance/controleur_soutenance.php";

class ModSoutenance extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Soutenances";
		$this->controleur = new ControleurSoutenance();
	}
}
?>