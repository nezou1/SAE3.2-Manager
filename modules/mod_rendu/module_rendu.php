<?php

require_once "RenduController.php";

class ModRendu extends ModuleGenerique{

    public function __construct () {
		parent::__construct();
		$this->title = "Evaluation";
		$this->controleur = new RenduController();
	}
}
?>