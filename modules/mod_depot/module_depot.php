<?php

require_once "depotController.php";

class ModDepot extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Depot";
		$this->controleur = new ControleurDepot();
	}
}
?>