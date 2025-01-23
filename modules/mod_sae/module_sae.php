<?php

require_once  "../modules/mod_sae/controleur_sae.php";

class ModSae extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Sae";
		$this->controleur = new ControleurSae();
	}
}
?>