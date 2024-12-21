<?php

require_once "C:/wamp64/www/SAE3.2-Manager/composants/menu/responsable/vue_menu_responsable.php";


class ControleurCompMenuResponsable {
	
	protected $vue;

	public function __construct() {
		$this->vue = new VueCompMenuResponsable();
	}

	public function exec () {
		$this->vue->vue_menu_responsable();
	}
	
	public function getVue() {
        return $this->vue;
    }
}
?>