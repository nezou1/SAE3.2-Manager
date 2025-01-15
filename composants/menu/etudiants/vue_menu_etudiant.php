<?php
class VueCompMenuEtudiant extends VueCompGenerique {

    public function __construct() {
        $this->affichage .= '
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand fw-bold text-uppercase" href="index.php?menu=etudiant&module=dashboard">
					<img src="../assets/logo.png" alt="Logo Site" style="height: 40px;" class="me-2">
				</a>
                <!-- Bouton pour mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="background-color: white;"></span>
                </button>

                <!-- Navigation principale -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?menu=etudiant&module=sae">Mes SAE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Trello</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Github</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?menu=etudiant&module=soutenance">Mes Soutenances</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="index.php?menu=connexion&module=connexion&action=logout">Déconnexion</a>
                        </li>
                    </ul>

                    <!-- Recherche et icônes -->
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control me-2" placeholder="Search" style="max-width: 200px; border-radius: 5px;">
                        <img src="../SAE3.2-Manager/assets/bell-icon.png" alt="Notifications" style="width: 24px; height: 24px; margin-right: 10px; cursor: pointer;">
                        <img src="../SAE3.2-Manager/assets/message-icon.png" alt="Messages" style="width: 24px; height: 24px; cursor: pointer;">
                    </div>
                </div>
            </div>';
    }
}
?>
