<?php

require_once PROJECT_ROOT . "/modules/mod_sae/modele_sae.php";
require_once PROJECT_ROOT . "/modules/mod_sae/vue_sae.php";

class ControleurSae {

	private $action;
    private $modele;
    private $vue;

    public function __construct() {
		$this->modele = new ModeleSae();
		$this->vue = new VueSae();
	}

    public function exec() {
		$this->action = isset($_GET["action"]) ? $_GET["action"] : "mes_saes";
		
		switch ($this->action) {
			case "mes_saes" :
				$this->mes_saes();
				break;
			case "form_creer_sae" :
				$enseignants = $this->modele->liste_enseignants($_SESSION['login']);
				$this->form_creer_sae($enseignants);
				break;
			case "creer_sae" :
				// if(isset($_POST["tokenCSRF"]) && $_POST["tokenCSRF"] == $_SESSION['token']){
					$this->creer_sae();
				/* } else {
					die("token incorrecte");
				}*/
				break;
			case "acceder_sae":
				if(isset($_GET['projet'])){
					$this->acceder_sae($_GET['projet']);
				}
			default : 
				die ("Action inexistante");
		}
	}

	public function mes_saes() {
		$liste = $this->modele->get_saes();
		$this->vue->mes_saes($liste);
	}

	public function form_creer_sae($enseignants) {
		$erreurs = [];
		$this->vue->form_creer_sae($enseignants,$erreurs);
	}

	public function creer_sae() {
		$titre = $_POST["titre"];
		$description = $_POST["description"];
		$annee = $_POST["annee"];
		$semestre = $_POST["semestre"];
		$date_depot = $_POST["date_depot"];
		$intervenants = isset($_POST["intervenants"]) ? $_POST["intervenants"] : null;

		var_dump($_POST["intervenants"]);
		$ressources = isset($_FILES["ressources"]) ? $_FILES["ressources"] : null;
		$highlights = isset($_POST["highlight"]) ? $_POST["highlight"] : null;

		// if (!$titre || !$description || !$annee || !$semestre || !$intervenants || !$ressources) {
		// 	$this->vue->erreurParametresManquants();
		// 	return;
		// }

		$erreurs = $this->modele->creer_sae(
			$titre, 
			$description, 
			$annee, 
			$semestre, 
			$date_depot, 
			$intervenants, 
			$ressources, 
			$highlights
		);

		if (is_array($erreurs) && !empty($erreurs)) {
			$enseignants = $this->modele->liste_enseignants($_SESSION['login']);
			$this->vue->form_creer_sae($enseignants,$erreurs); // Réaffiche le formulaire avec les erreurs et les données déjà saisies
		} else {
			// $this->vue->confirmeAjout();
		}
	}

	public function acceder_sae($sae) {
		$this->vue->acceder_sae($sae);
	}
}
?>