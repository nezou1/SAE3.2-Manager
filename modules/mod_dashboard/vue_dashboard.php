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
        <style>
            .carousel-item img {
                height: 350px; /* Ajustez selon vos besoins */
                object-fit: cover; /* Les images s'adaptent sans se déformer */
                width: 100%;
            }
            #calendar {
        max-width: 100%;
        height: 500px; /* Ajustez la hauteur si nécessaire */
        margin: 0 auto;
        padding: 10px;
    }
        </style>
    
        <div class="container-fluid mt-4">
            <div class="row">
                <!-- Colonne gauche : Carrousel -->
                <div class="col-lg-8">
                    <h4>Ressources</h4>
                    <div id="coursCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../assets/devwebImage.jpg" class="d-block w-100 rounded" alt="Développement Web">
                                <div class="carousel-caption">
                                    <h5>Développement Web</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="../assets/devwebImage.jpg" class="d-block w-100 rounded" alt="Programmation Java">
                                <div class="carousel-caption">
                                    <h5>Programmation Java</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="../assets/reseau.png" class="d-block w-100 rounded" alt="Systèmes et Réseaux">
                                <div class="carousel-caption">
                                    <h5>Systèmes et Réseaux</h5>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#coursCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#coursCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
    
                    <h4 class="mt-5">Projet en cours</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5>SAE Manager</h5>
                                    <a href="projet.php" class="btn btn-outline-dark">Voir le projet</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5>Refactoring & Design Pattern</h5>
                                    <a href="projet.php" class="btn btn-outline-dark">Voir le projet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <!-- Colonne droite : Calendrier et Alertes -->
                <div class="col-lg-4">
                    <h4>Calendrier</h4>
                    <div id="calendar"></div>
    
                    <h4 class="mt-4">Alertes</h4>
                    <div class="card mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div><strong>Jeudi 12 Septembre</strong> - Dépôt TP3</div>
                            <a href="depot.php" class="btn btn-outline-primary btn-sm">Déposer</a>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div><strong>Dimanche 15 Septembre</strong> - User Story</div>
                            <a href="depot.php" class="btn btn-outline-primary btn-sm">Déposer</a>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div><strong>Prochaine échéance :</strong> R3.01 - Dépôt TP4</div>
                            <a href="depot.php" class="btn btn-outline-primary btn-sm">Déposer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- FullCalendar JS -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const calendarEl = document.getElementById('calendar');
                if (calendarEl) {
                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        locale: 'fr',
                        events: [
                            { title: 'Dépôt TP3', start: '2024-09-12' },
                            { title: 'User Story', start: '2024-09-15' },
                            { title: 'R3.01 - Dépôt TP4', start: '2024-09-20' }
                        ]
                    });
                    calendar.render();
                } else {
                    console.error("Erreur : Élément #calendar introuvable.");
                }
            });
        </script>
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
