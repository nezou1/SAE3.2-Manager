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
                            <a class="nav-link" href="index.php?menu=enseignant&module=sae&menu=enseignant">Mes SAE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=enseignant&module=sae&action=form_creer_sae&menu=enseignant">Créer une SAE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=enseignant&module=rendu&menu=enseignant">Evaluation</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSoutenance" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Soutenance
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownSoutenance">
                                <li>
                                    <a class="dropdown-item" href="index.php?menu=enseignant&module=soutenance&action=form_ajout">Ajouter une soutenance</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?menu=enseignant&module=soutenance&action=liste">Liste des soutenances</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?menu=connexion&module=connexion&action=logout&menu=connexion">Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>';
	}	
}
?>
