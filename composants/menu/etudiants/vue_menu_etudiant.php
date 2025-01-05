<?php
class VueCompMenuEtudiant extends VueCompGenerique {

	public function __construct() {
		$this->affichage = '
		<nav class="navbar navbar-expand-lg navbar-light ">
			<div class="container-fluid">
				<!-- Logo -->
				<a class="navbar-brand fw-bold text-uppercase" href="index.php?module=dashboard">
					<img src="../assets/logo.png" alt="Logo Site" style="height: 40px;" class="me-2">
				</a>
	
				<!-- Bouton hamburger pour mobile -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
	
				<!-- Menu de navigation -->
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item">
							<a class="nav-link" href="index.php?module=mes_saes">Mes SAE</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?module=deposer_rendu">Déposer un rendu</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?module=soutenance">Mes Soutenances</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php?module=connexion&action=login">Déconnexion</a>
						</li>
						';
	
		// Ajouter le bouton Déconnexion si l'utilisateur est connecté
		if (isset($_SESSION['login'])) {
			$this->affichage .= '
						<li class="nav-item">
							<a class="nav-link text-danger" href="index.php?module=connexion&action=deconnexion">Déconnexion</a>
						</li>';
		}
	
		$this->affichage .= '
					</ul>
				</div>
			</div>
		</nav>
		';
	}
	
} 
?>
