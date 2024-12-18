<?php
require_once "modules/mod_connexion/controleur_connexion.php";

class ModConnexion {

	
	private $title;
	private $controleur;
	
	public function __construct () {
		$this->title = "";
		$this->controleur = new ControleurConnexion();
	}
	
	public function exec () {
		$this->controleur->exec();
	}



}




