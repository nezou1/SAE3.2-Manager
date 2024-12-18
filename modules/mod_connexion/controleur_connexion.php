<?php
require_once "modules/mod_connexion/vue_connexion.php";
require_once "modules/mod_connexion/modele_connexion.php";
require_once "csrfprotection.php";


class ControleurConnexion {

	private $modele;
	private $vue;
	private $action;
	
	public function __construct() {
		$this->modele = new ModeleConnexion();
		$this->vue = new VueConnexion();
	}
	
	public function exec() {
		$this->action = isset($_GET["action"]) ? $_GET["action"] : "liste";
		
		switch ($this->action) {
			case "form_connexion" :
				$this->form_connexion();
				break;
			case "verif_connexion" :
				$this->verif_connexion();
				break;
			case "form_inscription" :
				$this->form_inscription();
				break;
			case "inscription" : 
				$this->inscription();
				break;
			case "deconnexion" :
				$this->deconnexion();
				break;
			default : 
				die ("Action inexistante");
		}
	}
	
	private function form_connexion () {
		$this->vue->menu();
		$this->vue->form_connexion();	
	}
	
	private function form_inscription () {
		$this->vue->menu();
		$this->vue->form_inscription();
	}
	 
	private function verif_connexion () {
		$this->vue->menu();
		if (!isset($_POST['csrf_token']) || !CSRFProtection::validateToken($_POST['csrf_token'])) {
            die("Erreur CSRF : Token invalide");
        }

		$login = isset ($_POST['login']) ? $_POST['login'] : die ("paramètre manquant");
		$mdp = isset ($_POST['mdp']) ? $_POST['mdp'] : die ("paramètre manquant");
		$util = $this->modele->get_utilisateur ($login);
		if ($util === false) {
			$this->vue->utilisateur_inconnu($login);
			return;
		}
		if (password_verify($mdp, $util["mdp"])) {
			$_SESSION['login'] = $login;
			$this->vue->confirm_connexion($login);
		}
		else {
			$this->vue->echec_connexion($login);
		}
		CSRFProtection::removeToken();
	}

	private function inscription () {
		$this->vue->menu();
		if (!isset($_POST['csrf_token']) || !CSRFProtection::validateToken($_POST['csrf_token'])) {
            die("Erreur CSRF : Token invalide");
        }
		$login = isset ($_POST['login']) ? $_POST['login'] : die("paramètre manquant");
		$mdp = isset ($_POST['mdp']) ? $_POST['mdp'] : die ("paramètre manquant");
		$mdp_hash = password_hash($mdp, PASSWORD_BCRYPT);
		if ($this->modele->ajout_utilisateur($login, $mdp_hash)) {
			$this->vue->confirm_inscription($login);
		}
		else {
			$this->vue->erreur_inscription($login);
		}
		CSRFProtection::removeToken();
	}

        public function deconnexion () {
		unset($_SESSION['login']);
		$this->vue->confirm_deconnexion();
	}

}
