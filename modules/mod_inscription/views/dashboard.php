<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SAE Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F7F1E9;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #6c757d;
        }
        .navbar a {
            color: white;
            text-decoration: none;
        }
        .dashboard-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }
        .left-column, .right-column {
            width: 48%;
        }
        .carousel-item {
            text-align: center;
        }
        .carousel-item img {
            max-height: 150px;
            object-fit: contain;
            margin: 0 auto 10px;
        }
        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            border-radius: 5px;
            padding: 10px;
        }
        .calendar, .alerts {
            margin-bottom: 30px;
        }
        .alerts {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .alert-item {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Bonjour</a>
            <div>
                <a class="nav-link" href="#">Mes SAE</a>
                <a class="nav-link" href="#">Lien</a>
                <a class="nav-link" href="#">Lien</a>
            </div>

            <input type="search" placeholder="Rechercher" class="form-control me-2">
        </div>
    </nav>

    <!-- Contenu du dashboard -->
    <div class="dashboard-container container-fluid">
        <!-- Colonne gauche -->
        <div class="left-column">
            <!-- Carrousel des cours -->
            <div class="courses mb-5">
                <h4>Cours</h4>
                <div id="carouselCourses" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/cours1.png" alt="Développement Web">
                            <div class="carousel-caption">
                                <h5>Développement Web</h5>
                                <a href="/public/index.php?action=cours1" class="btn btn-primary">Voir le cours</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/cours2.png" alt="Analyse">
                            <div class="carousel-caption">
                                <h5>Analyse</h5>
                                <a href="/public/index.php?action=cours2" class="btn btn-primary">Voir le cours</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/cours3.png" alt="Programmation en Système">
                            <div class="carousel-caption">
                                <h5>Programmation en Système</h5>
                                <a href="/public/index.php?action=cours3" class="btn btn-primary">Voir le cours</a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselCourses" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Précédent</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselCourses" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>
                </div>
            </div>

            <!-- Carrousel des projets -->
            <div class="projects">
                <h4>Projets en cours</h4>
                <div id="carouselProjects" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/project1.png" alt="SAE Manager">
                            <div class="carousel-caption">
                                <h5>SAE Manager</h5>
                                <a href="/public/index.php?action=projet1" class="btn btn-primary">Voir le projet</a>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="assets/project2.png" alt="Refactoring & Design Pattern">
                            <div class="carousel-caption">
                                <h5>Refactoring & Design Pattern</h5>
                                <a href="/public/index.php?action=projet2" class="btn btn-primary">Voir le projet</a>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProjects" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Précédent</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselProjects" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Suivant</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Colonne droite -->
        <div class="right-column">
            <div class="calendar mb-4">
                <h4>Septembre 2024</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mo</th>
                            <th>Tu</th>
                            <th>We</th>
                            <th>Th</th>
                            <th>Fr</th>
                            <th>Sa</th>
                            <th>Su</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td><td></td><td></td><td>1</td><td>2</td><td>3</td><td>4</td>
                        </tr>
                        <tr>
                            <td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td>
                        </tr>
                        <tr>
                            <td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td>
                        </tr>
                        <tr>
                            <td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td>
                        </tr>
                        <tr>
                            <td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td></td><td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="alerts">
                <h4>Alertes</h4>
                <div class="alert-item">
                    <p><strong>Jeudi 12 Septembre</strong></p>
                    <p>R3.01 - Dépôt TP3</p>
                </div>
                <div class="alert-item">
                    <p><strong>Dimanche 15 Septembre</strong></p>
                    <p>R3.01 - User Story</p>
                </div>
                <div class="alert-item">
                    <p><strong>Dimanche 15 Septembre</strong></p>
                    <p>Click to upload</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
