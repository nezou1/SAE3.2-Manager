<?php
require_once "composants/menu/controleur_menu.php";

class ComposantMenuResponsable extends ComposantGenerique {
	public function __construct () {
		parent::__construct();
		$this->controleur = new ControleurCompMenuResponsable();
	}
}
?>