<?php
class VueCompMenuEnseignant extends VueCompGenerique {

	public function __construct(){
		$this->affichage .=
			'<div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand fw-bold text-uppercase" href="index.php?menu=enseignant&module=dashboard">
					<img src="../assets/logo.png" alt="Logo Site" style="height: 40px;" class="me-2">
				</a>
                <!-- Navigation principale -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=enseignant&module=sae">Mes SAE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=enseignant&module=sae&action=form_creer_sae">Créer une SAE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=enseignant&module=soutenance">Mes Soutenances</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=connexion&module=connexion&action=logout">Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>';
	}	
}
?>
