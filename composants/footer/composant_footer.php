<?php
require_once "C:/wamp64/www/SAE3.2-Manager/composants/footer/controleur_footer.php";

class ComposantFooter extends ComposantGenerique {
	public function __construct () {
		parent::__construct();
		$this->controleur = new ControleurCompFooter();
	}
}
?>