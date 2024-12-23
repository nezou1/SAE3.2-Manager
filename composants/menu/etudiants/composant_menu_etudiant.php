<?php
require_once "C:/wamp64/www/SAE3.2-Manager/composants/menu/etudiant/controleur_menu_etudiant.php";

class ComposantMenuEtudiant extends ComposantGenerique {
	public function __construct () {
		parent::__construct();
		$this->controleur = new ControleurCompMenuEtudiant();
	}
}
?>