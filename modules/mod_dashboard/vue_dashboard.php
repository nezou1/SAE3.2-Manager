<?php

class VueDashboard extends VueGenerique {

    public function __construct() {
        parent::__construct();  
    }

    public function get_dashboard() {
        
        //$this->afficherEtudiant();
        
    }

    // Vue pour le dashboard étudiant
    public function afficherEtudiant() {
        ?>
        <style>
            .carousel-item img {
                height: 350px; 
                object-fit: cover; 
                width: 100%;
            }
            #calendar {
        max-width: 100%;
        height: 500px; 
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
                    <div class="row mt-5">
                        <?php
                        $modele = new ModeleDashboard();
                        $groupes = $modele->getGroupesEtudiant($_SESSION['login']);
                        $this->afficherGroupesEtudiant($groupes);
                        ?>
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

    public function afficherGroupesEtudiant() {
        $modele = new ModeleDashboard();
        $groupes = $modele->getGroupesEtudiant();
        
        ?>
        <div class="container mt-5">
            <h4 class="mb-4">Mes Groupes</h4>
            <?php if (!empty($groupes)): ?>
                <div id="groupesCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach (array_chunk($groupes, 4) as $index => $groupeChunk): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <div class="row">
                                    <?php foreach ($groupeChunk as $idGroupe): ?>
                                        <div class="col-md-3 mb-3">
                                            <div class="card text-center shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="card-title">Groupe <?= htmlspecialchars($idGroupe) ?></h5>
                                                    <p class="text-muted">Collègues :</p>
                                                    <ul class="list-unstyled">
                                                        <?php 
                                                        $membres = $modele->getMembreGroupe($idGroupe);
                                                        if (is_array($membres)) {
                                                            foreach ($membres as $membre): ?>
                                                                <li><?= htmlspecialchars($membre['prenom'] . ' ' . $membre['nom']) ?></li>
                                                            <?php endforeach;
                                                        } else {
                                                            echo "<li>Aucun membre trouvé.</li>";
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#groupesCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#groupesCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            <?php else: ?>
                <p class="text-center">Vous n'appartenez à aucun groupe pour le moment.</p>
            <?php endif; ?>
        </div>
        <?php
    }

    // Vue pour le dashboard enseignant

    public function afficherEnseignant() {
        ?>
        <link rel="stylesheet" href="../assets/css/styleDashboardEnseignant.css">
        <div class="container-fluid mt-4">
            <div class="row mt-5">
                <!-- Colonne gauche : Projets et ressources -->
                <div class="col-lg-8">
                    <?php
                    $this->afficherProjets();  // Section Projets SAE
                    $this->afficherRessources();// Section Ressources
                    $this->raccourcisEnseignant();  // Nouvelle section Raccourcis
                    
                    ?>
                </div>
                <!-- Colonne droite : Rendus et alertes -->
                <div class="col-lg-4">
                <h4>Calendrier</h4>
                <?php $this->calendrier(); ?>
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
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>SAE Manager</h5>
                        <p>Deadline : 20/03/2025</p>
                        <a href="projet_gestion.php" class="btn btn-outline-dark">Gérer le projet</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Refactoring & Design Pattern</h5>
                        <p>Deadline : 25/03/2025</p>
                        <a href="projet_gestion.php" class="btn btn-outline-dark">Gérer le projet</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Ajouter un projet</h5>
                        <a href="./index.php?menu=enseignant&module=sae&action=form_creer_sae" class="btn btn-outline-dark">
                            <i class="fas fa-plus"> + </i>
                        </a>
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
                <h5>Accedez au gestionnaire de ressource</h5>
                <a href="./index.php?module=gestionnaireRessource&action=exec&menu=enseignant" class="btn btn-outline-primary">Consulter</a>
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

    private function raccourcisEnseignant() {
        ?>
        <h4 class="mt-5">Raccourcis</h4>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Vue d'ensemble sur les groupes</h5>
                        <p class="text-muted">Consultez les informations sur les groupes et les projets associés.</p>
                        <a href="groupes_ensemble.php" class="btn btn-outline-primary">Voir les groupes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Liste des étudiants</h5>
                        <p class="text-muted">Accédez à la liste des étudiants inscrits.</p>
                        <a href="./index.php?module=liste&action=listeEtudiants&menu=enseignant" class="btn btn-outline-primary">Voir les étudiants</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Liste des enseignants intervenants</h5>
                        <p class="text-muted">Découvrez la liste des enseignants impliqués dans les projets.</p>
                        <a href="./index.php?module=liste&action=listeEnseignants&menu=enseignant" class="btn btn-outline-primary">Voir les enseignants</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function afficherListeEtudiants() {
        try {
            // Connexion à la base de données via getConnexion()
            $bdd = $this->getConnexion();
    
            // Requête SQL pour récupérer les étudiants
            $sql = "SELECT idEtud, nom, prenom, email FROM Etudiant";
            $result = $bdd->query($sql);
    
            // Affichage du tableau HTML des étudiants
            ?>
            <div class="container mt-5">
                <h2 class="mb-4">Liste des étudiants</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && $result->num_rows > 0):
                            while ($etudiant = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($etudiant['idEtud']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['prenom']); ?></td>
                                    <td><?php echo htmlspecialchars($etudiant['email']); ?></td>
                                </tr>
                            <?php endwhile;
                        else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Aucun étudiant trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php
    
            // Fermer la connexion
            $bdd->close();
        } catch (Exception $e) {
            echo "<p class='alert alert-danger'>Erreur lors de la récupération des étudiants : " . $e->getMessage() . "</p>";
        }
    }
    
}
