<?php

require_once "C:/wamp64/www/SAE3.2-Manager/modules/mod_sae/controleur_sae.php";

class ModSae extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Sae";
		$this->controleur = new ControleurSae();
	}
}
?>