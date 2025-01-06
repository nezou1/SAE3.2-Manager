<?php
class VueCompMenuEtudiant extends VueCompGenerique {

	/*public function __construct() {
		$this->affichage = '
		
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
		';
	}*/

public function __construct() {
    $this->affichage = '
        <link rel="stylesheet" href="../assets/css/styleNav.css">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Bouton hamburger pour mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu de navigation -->
            <div class="navbar-left">
                <img src="../assets/logo.png" alt="Profile Icon" class="profile-icon">
            </div>
            <div class="navbar-center">
                <nav>
                    <a href="#">Mes SAE</a>
                    <a href="#">Créer une SAE</a>
                    <a href="#">Planning</a>
                    <a href="#">Lien</a>
                </nav>
            </div>
            <div class="navbar-right d-flex align-items-center">
                <input type="text" placeholder="Search" class="search-input me-2">
                <img src="../assets/bell-icon.png" alt="Notifications" class="icon me-2">
                <img src="../assets/message-icon.png" alt="Messages" class="icon">
            </div>
        </div>';

    // Ajouter le lien de déconnexion si l'utilisateur est connecté
    if (isset($_SESSION['login'])) {
        $this->affichage .= '
            <div class="navbar-right mt-2">
                <a class="btn btn-outline-danger" href="index.php?module=connexion&action=deconnexion">Déconnexion</a>
            </div>';
    }
}

	
} 
?>
