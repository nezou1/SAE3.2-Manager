<?php 
class ModeleConnexion extends Connexion {

	public function get_utilisateur ($login) {
		$req = self::$bdd->prepare("SELECT * from utilisateur WHERE login=?");
		$req->execute([$login]);
		return $req->fetch();
	}

	public function ajout_utilisateur ($login, $mdp_hash) {
		$req = self::$bdd->prepare("INSERT INTO utilisateur (login, mdp) VALUES(:login, :mdp)");
		return $req->execute(["login"=>$login, "mdp"=>$mdp_hash]);
	}


}
