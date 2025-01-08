<?php

require_once PROJECT_ROOT . "/modules/mod_sae/controleur_sae.php";

class ModSae extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Sae";
		$this->controleur = new ControleurSae();
	}
}
?>