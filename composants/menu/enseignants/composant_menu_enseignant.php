<?php
require_once PROJECT_ROOT . "/composants/menu/enseignants/controleur_menu_enseignant.php";

class ComposantMenuEnseignant extends ComposantGenerique {
	public function __construct () {
		parent::__construct();
		$this->controleur = new ControleurCompMenuEnseignant();
	}
}
?>