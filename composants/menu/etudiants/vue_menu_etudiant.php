<?php
class VueCompMenuEtudiant extends VueCompGenerique {

	public function __construct(){
		$this->affichage .=
			'<div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="index.php?module=accueil">LOGO SITE</a>

                <!-- Navigation principale -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=etudiant&module=sae">Mes SAE</a>
                        </li>
                        <li class="nav-item">
							<a class="nav-link" href="index.php?menu=etudiant&module=deposer_rendu">Deposer un rendu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=etudiant&module=soutenance">Mes Soutenances</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=etudiant&module=connexion&action=deconnexion">Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>';

            <div class="navbar-left">
            <img src="profile-icon.png" alt="Profile Icon" class="profile-icon">
        </div>
        <div class="navbar-center">
            <nav>
                <a href="#">Mes SAE</a>
                <a href="#">Créer une SAE</a>
                <a href="#">Planning</a>
                <a href="#">Lien</a>
            </nav>
        </div>
        <div class="navbar-right">
            <input type="text" placeholder="Search" class="search-input">
            <img src="bell-icon.png" alt="Notifications" class="icon">
            <img src="message-icon.png" alt="Messages" class="icon">
        </div>
	}
} 
?>
