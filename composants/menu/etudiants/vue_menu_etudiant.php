<?php
class VueCompMenuEtudiant extends VueCompGenerique {

	public function __construct(){
		$this->affichage .=
					'<ul>
						<li><a href="index.php?module=accueil">LOGO Site</a></li>
						<li><a href="index.php?module=mes_saes">Mes SAE</a></li>
						<li><a href="index.php?module=deposer_rendu">Deposer un rendu</a></li>
						<li><a href="index.php?module=soutenance">Mes Soutenances</a></li>';
						if (isset($_SESSION['login'])) {
							$this->affichage .= '<li><a href="index.php?module=connexion&action=deconnexion">Déconnexion</a></li>';
						}
$this->affichage .= '</ul>';
	}	
} 
?>
