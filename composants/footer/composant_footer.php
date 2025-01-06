<?php
require_once PROJECT_ROOT . "/composants/footer/controleur_footer.php";

class ComposantFooter extends ComposantGenerique {
	public function __construct () {
		parent::__construct();
		$this->controleur = new ControleurCompFooter();
	}
}
?>