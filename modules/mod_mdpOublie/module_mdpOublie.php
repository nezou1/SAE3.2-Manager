<?php

require_once "ForgotPasswordController.php";

class ModmdpOublie extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "mdpOubie";
		$this->controleur = new ControleurMdpOublie();
	}
}
?>