<?php
require_once "controleur_menu_connexion.php";

class ComposantMenuConnexion extends ComposantGenerique {
	public function __construct () {
		parent::__construct();
		$this->controleur = new ControleurCompMenuConnexion();
	}
}
?>