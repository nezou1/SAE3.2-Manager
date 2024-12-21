<?php

require_once "C:/wamp64/www/SAE3.2-Manager/modules/mod_soutenance/modele_soutenance.php";
require_once "C:/wamp64/www/SAE3.2-Manager/modules/mod_soutenance/vue_soutenance.php";

class ControleurSoutenance {

	private $action;
    private $modele;
    private $vue;

    public function __construct() {
		$this->modele = new ModeleSoutenance();
		$this->vue = new VueSoutenance();
	}

    public function exec() {
		$this->action = isset($_GET["action"]) ? $_GET["action"] : "liste";
		
		switch ($this->action) {
			case "liste" :
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
		$this->vue->get_soutenances($tableau);
	}

    private function form_ajout () {
		$erreurs = [];
		$this->vue->form_ajout($erreurs);
		$tableau = $this->modele->get_soutenances();
		$this->vue->get_liste_soutenances($tableau);
	}

	private function ajout($nomGroupe, $description, $sae, $date, $de, $a, $lieu, $jurys) {
		  // Récupérer les données du formulaire avec gestion des paramètres manquants
		  $nom_groupe = isset($_POST["nom_groupe"]) ? $_POST["nom_groupe"] : null;
		  $description = isset($_POST["description"]) ? $_POST["description"] : null;
		  $sae = isset($_POST["sae"]) ? $_POST["sae"] : null;
		  $date = isset($_POST["dateSout"]) ? $_POST["dateSout"] : null;
		  $de = isset($_POST["heureDebut"]) ? $_POST["heureDebut"] : null;
		  $a = isset($_POST["heureFin"]) ? $_POST["heureFin"] : null;
		  $lieu = isset($_POST["lieu"]) ? $_POST["lieu"] : null;
		  $jurys = isset($_POST["jurys"]) ? $_POST["jurys"] : null;
	  
		  // Vérifier les paramètres manquants
		  if (!$nom_groupe || !$description || !$sae || !$date || !$de || !$a || !$lieu || !$jurys) {
			  $this->vue->erreurParametresManquants();
			  return;
		  }
	  
		  // Appeler le modèle pour ajouter la soutenance avec les validations
		  $erreurs = $this->modele->ajout($nom_groupe, $description, $sae, $date, $de, $a, $lieu, $jurys);
	  
		  // Vérifier si des erreurs sont retournées
		  if (is_array($erreurs) && !empty($erreurs)) {
			  $this->vue->form_ajout($erreurs); // Réaffiche le formulaire avec les erreurs et les données déjà saisies
		  } else {
			  // Si tout est correct, confirmer l'ajout
			  $this->vue->confirmeAjout();
		  }
	}
}
?>