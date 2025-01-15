<?php
require_once  "../composants/menu/connexion/controleur_menu_connexion.php";

class ComposantMenuConnexion extends ComposantGenerique {
	public function __construct () {
		parent::__construct();
		$this->controleur = new ControleurCompMenuConnexion();
	}
}
?>