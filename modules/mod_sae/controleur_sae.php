<?php

require_once  "../modules/mod_sae/modele_sae.php";
require_once  "../modules/mod_sae/vue_sae.php";

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
				$this->form_creer_sae();
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
					$this->acceder_sae();
				}
				else {
					die ("SAE introuvable");
				}
				break;
			case "ajouter_soutenance":
				// if(isset($_POST["tokenCSRF"]) && $_POST["tokenCSRF"] == $_SESSION['token']){
				$this->ajouter_soutenance();
				/* } else {
					die("token incorrecte");
				}*/
				break;
			case "ajouter_groupe":
				// if(isset($_POST["tokenCSRF"]) && $_POST["tokenCSRF"] == $_SESSION['token']){
				$this->ajouter_groupe();
				/* } else {
					die("token incorrecte");
				}*/
				break;
			default : 
				die ("Action inexistante");
		}
	}

	public function mes_saes() {
		$id = ($_GET['menu'] == 'enseignant') ? $this->modele->get_id_enseignant($_SESSION['login']) :  $this->modele->get_id_etudiant($_SESSION['login']);
		$liste = $this->modele->get_saes($id);
		$this->vue->mes_saes($liste);
	}

	public function form_creer_sae() {
		$erreurs = [];
		$this->vue->form_creer_sae($erreurs);
	}

	public function creer_sae() {
		$erreurs = $this->modele->creer_sae();

		if (is_array($erreurs) && !empty($erreurs)) {
			$this->vue->form_creer_sae($erreurs); // Réaffiche le formulaire avec les erreurs et les données déjà saisies
		}
		else
			$this->vue->confirmeAjout();

	}

	public function acceder_sae() {
		$id_ens = $this->modele->get_id_enseignant($_SESSION['login']);
		$sae = $this->modele->get_projet($_GET['projet']);

		$enseignants = $this->modele->get_enseignants_sae($_GET['projet']);
		$ressources = $this->modele->get_ressources_sae($_GET['projet']);
		$groupes = $this->modele->get_groupes_sae($_GET['projet']);
		$etudiants = $this->modele->get_etudiants_sans_grp();
		// $rendus = $this->modele->get_rendus_sae($_GET['projet']);
		$soutenances = $this->modele->get_soutenances_sae($_GET['projet']);

		$this->vue->acceder_sae(
			$sae, 
			$enseignants, 
			$ressources, 
			$groupes,
			$etudiants,
			// $rendus,
			$soutenances
		);
	}

	public function ajouter_groupe() {
		// $erreurs = 
		$this->modele->ajouter_groupe();

		// if (is_array($erreurs) && !empty($erreurs)) {
		// 	$this->vue->form_ajouter_groupe($erreurs); // Réaffiche le formulaire avec les erreurs et les données déjà saisies
		// }

		header('Location: ./index.php?menu=enseignant&module=sae&action=acceder_sae&projet=' . $_GET['projet']);

	}

	public function ajouter_soutenance() {
		$erreurs = $this->modele->ajouter_soutenance();

		// if (is_array($erreurs) && !empty($erreurs)) {
		// 	$this->vue->form_creer_sae($erreurs); // Réaffiche le formulaire avec les erreurs et les données déjà saisies
		// }
		// else
		// 	$this->vue->confirmeAjout();
	}
}
?>