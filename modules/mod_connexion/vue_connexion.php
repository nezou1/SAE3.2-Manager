<?php
require_once "csrfprotection.php";
class VueConnexion {
	public function __construct () {


	}

	public function form_connexion() {
		$csrfToken = CSRFProtection::generateToken();
?>
		<h1>Connexion</h1>
		<form action="index.php?module=connexion&action=verif_connexion" method="POST">
		<?php echo CSRFProtection::genererTokenInput(); ?>
			login : <input type="text" name="login"></input>
			mot de passe : <input type="password" name="mdp"></input>
			<input type="submit"/>
		</form>
<?php

	}

	public function form_inscription() {
		$csrfToken = CSRFProtection::generateToken();
?>
		<h1>Inscription</h1>
		<form action="index.php?module=connexion&action=inscription" method="POST">
		<?php echo CSRFProtection::genererTokenInput(); ?>
			login : <input type="text" name="login"></input>
			mot de passe : <input type="password" name="mdp"></input>
			<input type="submit"/>
		</form>
<?php

	}	

	public function menu() {
		?><a href="index.php?module=connexion&action=form_connexion">Connexion</a>
		<a href="index.php?module=connexion&action=form_inscription">Inscription</a>
		<?php
	}

	public function confirm_inscription($login) {
?>
	Inscription de <?=htmlspecialchars($login)?> réussie !
<?php
	}
	public function erreur_inscription($login) {
?>
	Echec de l'inscription de <?=htmlspecialchars($login)?>
<?php
	}

	public function confirm_connexion ($login) {
?>
	Connexion en tant que <?=htmlspecialchars($login)?> réussie !
<?php
	}

	public function echec_connexion ($login) {
?>
	Echec de la connexion en tant que <?=htmlspecialchars($login)?>
<?php
	}

	public function utilisateur_inconnu ($login) {
?>
	Utilisateur <?=htmlspecialchars($login)?> inconnu
<?php
	}

	public function confirm_deconnexion() {
		?>
		Vous êtes bien déconnecté(e)
		<?php
	}

}
