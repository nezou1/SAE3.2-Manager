<?php

class VueDashboard extends VueGenerique {

    public function __construct() {
        parent::__construct();  // Appelle le constructeur de VueGenerique (si nécessaire)
    }

    // Méthode principale pour afficher le tableau de bord en fonction du rôle
    public function get_dashboard() {
        
        $this->afficherEtudiant();
        
    }

    // Vue pour le dashboard étudiant
    private function afficherEtudiant() {
        ?>
        <!-- Container principal -->
        <div class="container-fluid mt-4">
            <!-- Barre de navigation -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
            </nav>
    
            <!-- Contenu principal -->
            <div class="row mt-4">
                <!-- Colonne gauche -->
                <div class="col-lg-8">
                    <!-- Section Cours (Carrousel Bootstrap) -->
                    <h4>Cours</h4>
                    <div id="coursCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../assets/web.jpg" class="d-block w-100 rounded" alt="Développement Web">
                                <div class="carousel-caption">
                                    <h5>Développement Web</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="../assets/java.jpg" class="d-block w-100 rounded" alt="Programmation Java">
                                <div class="carousel-caption">
                                    <h5>Programmation Java</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="../assets/system.jpg" class="d-block w-100 rounded" alt="Systèmes et Réseaux">
                                <div class="carousel-caption">
                                    <h5>Systèmes et Réseaux</h5>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#coursCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#coursCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
    
                    <!-- Section Projets en cours -->
                    <h4 class="mt-5">Projet en cours</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5>SAE Manager</h5>
                                    <a href="projet.php" class="btn btn-outline-dark">Voir le projet</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5>Refactoring & Design Pattern</h5>
                                    <a href="projet.php" class="btn btn-outline-dark">Voir le projet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Colonne droite -->
                <div class="col-lg-4">
                    <!-- Section Calendrier -->
                    <h4>Calendrier</h4>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row text-center">
                                <?php for ($day = 1; $day <= 30; $day++): ?>
                                    <div class="col-1 border p-2"><?= $day ?></div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
    
                    <!-- Section Alertes -->
                    <h4>Alertes</h4>
                    <div class="list-group">
                        <a href="depot.php" class="list-group-item list-group-item-action">
                            <strong>Jeudi 12 Septembre</strong> - Dépôt TP3
                        </a>
                        <a href="depot.php" class="list-group-item list-group-item-action">
                            <strong>Dimanche 15 Septembre</strong> - User Story
                        </a>
                        <a href="depot.php" class="list-group-item list-group-item-action">
                            <strong>Prochaine échéance :</strong> R3.01 - Dépôt TP4
                        </a>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Ajout des styles CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
        <?php
    }
    

    // Vue pour le dashboard enseignant
    private function afficherEnseignant() {
        ?>
        <h1>Dashboard Enseignant</h1>
        <p>Bienvenue,!</p>
        <div class="nav-bar">
            <a href="index.php">Accueil</a>
            <a href="cours.php">Mes Cours</a>
            <a href="etudiants.php">Gestion des étudiants</a>
            <a href="creation_sae.php">Création de SAE</a>
        </div>
        <div class="content">
            <h2>Gestion des cours</h2>
            <p>Accédez à vos cours, gérez vos SAE, et consultez les travaux déposés par les étudiants.</p>
        </div>
        <?php
    }


}
