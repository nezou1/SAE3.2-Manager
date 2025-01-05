<?php

require_once "dashboardController.php";

class ModDashboard extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Dashboard";
		$this->controleur = new ControleurDashboard();
	}
}
?>