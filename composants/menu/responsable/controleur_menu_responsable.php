<?php

require_once "composants/menu/vue_menu_responsable.php";


class ControleurCompMenuResponsable {
	
	protected $vue;

	public function __construct() {
		$this->vue = new VueCompMenuResponsable();
	}

	public function exec () {
		$this->vue->vue_menu();
	}
	
	public function getVue() {
        return $this->vue;
    }
}
?>