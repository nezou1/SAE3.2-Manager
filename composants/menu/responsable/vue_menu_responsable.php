<?php
class VueCompMenuResponsable extends VueCompGenerique {

	public function __construct(){
		$this->affichage .=
			'<ul>
				<li><a href="index.php?module=accueil">LOGO SITE</a></li>
				<li><a href="index.php?module=mes_saes">Mes SAE</a></li>
				<li><a href="index.php?module=creer_sae">Créer une SAE</a></li>
				<li><a href="index.php?module=mes_soutenances">Mes Soutenances</a></li>
				<li><a href="index.php?module=connexion&action=deconnexion>Se Déconnecter</a></li>
			</ul>';
	}	
}
?>
