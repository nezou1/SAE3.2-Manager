<?php

require_once "../composants/menu/enseignants/vue_menu_enseignant.php";


class ControleurCompMenuEnseignant {
	
	protected $vue;

	public function __construct() {
		$this->vue = new VueCompMenuEnseignant();
	}

	public function exec () {
		$this->vue->vue_menu_enseignant();
	}
	
	public function getVue() {
        return $this->vue;
    }
}
?>