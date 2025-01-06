<?php
require_once PROJECT_ROOT . "/composants/menu/etudiant/controleur_menu_etudiant.php";

class ComposantMenuEtudiant extends ComposantGenerique {
	public function __construct () {
		parent::__construct();
		$this->controleur = new ControleurCompMenuEtudiant();
	}
}
?>