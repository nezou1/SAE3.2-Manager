<?php
require_once "C:/wamp64/www/SAE3.2-Manager/composants/menu/responsable/controleur_menu_responsable.php";

class ComposantMenuResponsable extends ComposantGenerique {
	public function __construct () {
		parent::__construct();
		$this->controleur = new ControleurCompMenuResponsable();
	}
}
?>