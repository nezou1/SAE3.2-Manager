<?php

require_once PROJECT_ROOT . "/composants/footer/vue_footer.php";

class ControleurCompFooter {

	private $vue;
	
	public function __construct() {
		$this->vue = new VueCompFooter();
	}


	public function exec () {
		$this->vue->vue_footer();
	}	

	public function getVue() {
        return $this->vue;
    }
}
?>