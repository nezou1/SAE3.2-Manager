<?php

require_once "composants/menu/vue_menu.php";


class ControleurCompMenu {
	
	protected $vue;

	public function __construct() {
		$this->vue = new VueCompMenu();
	}

	public function exec () {
		$this->vue->vue_menu();
	}
	
	public function getVue() {
        return $this->vue;
    }
}
?>