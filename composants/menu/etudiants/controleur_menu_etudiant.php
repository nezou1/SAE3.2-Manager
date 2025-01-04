<?php

require_once "C:/wamp64/www/FULL_PROJECT/composants/menu/etudiant/vue_menu_etudiant.php";


class ControleurCompMenuEtudiant {
	
	protected $vue;

	public function __construct() {
		$this->vue = new VueCompMenuEtudiant();
	}

	public function exec () {
		$this->vue->vue_menu_etudiant();
	}
	
	public function getVue() {
        return $this->vue;
    }
}
?>