<?php
class VueCompMenuEnseignant extends VueCompGenerique {

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
                        <a href="#">Enseignement</a>
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
