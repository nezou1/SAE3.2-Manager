<?php

require_once "modules/mod_soutenance/modele_soutenance.php";
require_once "modules/mod_soutenance/vue_soutenance.php";

class ControleurSoutenance {

    private $modele;
    private $vue;

    public function __construct() {
		$this->modele = new ModeleSoutenance();
		$this->vue = new VueSoutenance();
	}

    public function exec() {
		$this->action = isset($_GET["action"]) ? $_GET["action"] : "soutenances";
		
		switch ($this->action) {
			case "soutenances" :
				$this->get_soutenances();
				break;
			case "form_ajout" :
				$this->form_ajout();
				break;
			case "ajout" :
				if(isset($_POST["tokenCSRF"]) && $_POST["tokenCSRF"] == $_SESSION['token']){
					$this->ajout();
				} else {
					die("token incorrecte");
				}
				break;
			default : 
				die ("Action inexistante");
			
		}
	}

    private function get_soutenances () {
		$tableau = $this->modele->get_soutenances();
		$this->vue->planning($tableau);
	}

    private function form_ajout () {
		$this->vue->form_ajout();
	}

	private function ajout($nomGroupe, $description, $sae, $date, $de, $a, $lieu, $jurys) {
		$nom_groupe = isset ($_POST["nom_groupe"]) ? $_POST["nom_groupe"] : die("Paramètre manquant");
		$description = isset ($_POST["description"]) ? $_POST["description"] : die("Paramètre manquant");
		$sae = isset ($_POST["sae"]) ? $_POST["sae"] : die("Paramètre manquant");
		$date = isset ($_POST["dateSout"]) ? $_POST["dateSout"] : die("Paramètre manquant");
		$de = isset ($_POST["heureDebut"]) ? $_POST["heureDebut"] : die("Paramètre manquant");
		$a = isset ($_POST["heureFin"]) ? $_POST["heureFin"] : die("Paramètre manquant");
		$lieu = isset ($_POST["lieu"]) ? $_POST["lieu"] : die("Paramètre manquant");
		$jurys = isset ($_POST["jurys"]) ? $_POST["jurys"] : die("Paramètre manquant");

		if ($this->modele->ajout($nom_groupe, $description, $sae, $date, $de, $a, $lieu, $jurys)) {
			$this->vue->menu();
			$this->vue->confirmAjout();
		}
		else {
			$this->vue->menu();
			$this->vue->erreurBD();
		}
	}
}
?>