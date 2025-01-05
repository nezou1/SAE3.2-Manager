<?php
class VueCompMenuEnseignant extends VueCompGenerique {

	public function __construct(){
		$this->affichage .=
			'       
            <a class="navbar-brand" href="#">
                <img src="../assets/logo.png" alt="Logo SAE Manager" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="cours.php">Mes SAE</a></li>
                    <li class="nav-item"><a class="nav-link" href="ressources.php">Ressources</a></li>
                    <li class="nav-item"><a class="nav-link" href="depot.php">Dépôt de documents</a></li>
                </ul>
            </div>
        ';
	}	
}
?>
