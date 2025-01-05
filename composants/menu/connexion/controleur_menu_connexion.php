<?php

require_once "vue_menu_connexion.php";


class ControleurCompMenuConnexion{
	
	protected $vue;

	public function __construct() {
		$this->vue = new VueCompMenuConnexion();
	}

	public function exec () {
		$this->vue->vue_menu_connexion();
	}
	
	public function getVue() {
        return $this->vue;
    }
}
?>