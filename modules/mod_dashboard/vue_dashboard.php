<?php

class VueDashboard extends VueGenerique {

    public function __construct() {
        parent::__construct();  // Appelle le constructeur de VueGenerique (si nécessaire)
    }

    // Méthode principale pour afficher le tableau de bord en fonction du rôle
    public function get_dashboard() {
        
        //$this->afficherEtudiant();
        
    }

    // Vue pour le dashboard étudiant
    public function afficherEtudiant() {
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
                    <?php $this->calendrier(); ?>
                    <h4 class="mt-4">Alertes</h4>
                    <?php
                    for ($i = 0; $i < 3; $i++) {
                        $this->alerte("R3.01 - Dépôt TP4", "Jeudi 17 Septembre");
                    } 
                    ?>                    
                </div>
            </div>
        </div>

        <?php
    }

    public function calendrier(){
    ?>
    <link rel="stylesheet" href="../assets/css/styleCalendrier.css"> 
    <script src="../assets/script/scriptCalendrier.js"></script>

    <div class="calendar-container">
        <div class="calendar-header">
            <h3 id="calendar-title">Septembre 2024</h3>
        </div>
        <div class="calendar-body" id="calendar-body"></div>
    </div>
    <?php

    }

    private function alerte($message, $date){
        ?>
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><strong> <?= $date ?> </strong> - <?= $message?> </div>
                <a href="depot.php" class="btn btn-outline-primary btn-sm">Déposer</a>
            </div>
        </div>
        <?php
    }
    

    // Vue pour le dashboard enseignant
   /* public function afficherEnseignant() {
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
    }*/

    public function afficherEnseignant() {
        ?>
        <div class="container-fluid mt-4">
            <div class="row">
                <!-- Section Cours gérés par l'enseignant -->
                <div class="col-lg-12">
                    <?php $this->afficherCours(); ?>
                </div>
            </div>
            <div class="row mt-5">
                <!-- Colonne gauche : Projets et ressources -->
                <div class="col-lg-8">
                    <?php
                    $this->afficherProjets();  // Section Projets SAE
                    $this->afficherRessources();  // Section Ressources
                    ?>
                </div>
                <!-- Colonne droite : Rendus et alertes -->
                <div class="col-lg-4">
                    <?php
                    $this->afficherRendus();  // Section Rendus en attente
                    $this->afficherAlertes();  // Section Alertes
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    // Section Mes Cours (sous forme de cartes horizontales défilantes)
    private function afficherCours() {
        ?>
        <h4 class="mb-3">Pages récemment consultées</h4>
        <div class="course-container d-flex overflow-auto gap-3 p-2">
            <?php
            $cours = [
                ["Tableau de bord", "18 déc. 2024", "coffee-icon.png"],
                ["Maison", "28 déc. 2024", "home-icon.png"],
                ["Alternance", "24 sept. 2024", "grade-icon.png"],
                ["Équipe", "13 oct. 2024", "team-icon.png"],
                ["Construction Maison", "20 nov. 2024", "build-icon.png"],
                ["Cours", "4 déc. 2024", "book-icon.png"],
            ];

            foreach ($cours as $coursItem) {
                ?>
                <div class="course-card p-3 rounded shadow-sm text-center">
                    <img src="../assets/icons/<?= $coursItem[2] ?>" alt="<?= $coursItem[0] ?>" class="icon mb-2">
                    <h6><?= htmlspecialchars($coursItem[0]) ?></h6>
                    <p class="text-muted mb-0"><?= $coursItem[1] ?></p>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    // Section Projets SAE
    private function afficherProjets() {
        ?>
        <h4 class="mt-5">Projets SAE Créés</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>SAE Manager</h5>
                        <p>Deadline : 20/03/2025</p>
                        <a href="projet_gestion.php" class="btn btn-outline-dark">Gérer le projet</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Refactoring & Design Pattern</h5>
                        <p>Deadline : 25/03/2025</p>
                        <a href="projet_gestion.php" class="btn btn-outline-dark">Gérer le projet</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    // Autres sections (Alertes, Rendus, Ressources) restent inchangées
    private function afficherRessources() {
        ?>
        <h4>Ressources</h4>
        <div class="card text-center">
            <div class="card-body">
                <h5>Documentation pour le module</h5>
                <a href="ressources.php" class="btn btn-outline-primary">Consulter</a>
            </div>
        </div>
        <?php
    }

    private function afficherRendus() {
        ?>
        <h4>Rendus en attente</h4>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Dépôt TP1 - Étudiant A
                <a href="corriger.php" class="btn btn-outline-primary btn-sm">Corriger</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                User Story - Étudiant B
                <a href="corriger.php" class="btn btn-outline-primary btn-sm">Corriger</a>
            </li>
        </ul>
        <?php
    }

    private function afficherAlertes() {
        ?>
        <h4 class="mt-4">Alertes</h4>
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><strong>Mercredi 15 Février</strong> - Réunion pédagogique</div>
                <a href="details.php" class="btn btn-outline-secondary btn-sm">Détails</a>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div><strong>Vendredi 18 Février</strong> - Fin des évaluations SAE 3.1</div>
                <a href="details.php" class="btn btn-outline-secondary btn-sm">Détails</a>
            </div>
        </div>
        <?php
    }
}
