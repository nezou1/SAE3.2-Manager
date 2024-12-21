<?php
class VueCompMenuResponsable extends VueCompGenerique {

	public function __construct(){
		$this->affichage .=
			'<ul>
				<li><a href="index.php?module=accueil">LOGO SITE</a></li>
				<li><a href="index.php?module=mes_saes">Mes SAE</a></li>
				<li><a href="index.php?module=creer_sae">Créer une SAE</a></li>
				<li><a href="index.php?module=soutenance">Mes Soutenances</a></li>';
				if (isset($_SESSION['login'])) {
					$this->affichage .= '<li><a href="index.php?module=connexion&action=deconnexion">Déconnexion</a></li>';
				}
			$this->affichage .= '</ul>';
	}	
}
?>
