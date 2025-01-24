<?php

class VueListe extends VueGenerique {

    public function __construct() {
        parent::__construct();  
    }

    public function get_Liste() {
        
        //$this->afficherEtudiant();
        
    }

    public function afficherListeEtudiants($etudiants) {
    
        // Affichage du tableau HTML des étudiants
        ?>
        <script>
           document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('searchInput').addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const rows = document.querySelectorAll('#etudiantTable tbody tr');
                rows.forEach(row => {
                    const nom = row.cells[0].textContent.toLowerCase();
                    const prenom = row.cells[1].textContent.toLowerCase();
                    if (nom.includes(searchValue) || prenom.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
        </script>
        
        <div class="container mt-5">
            <h2 class="mb-4">Voici la liste souhaité</h2>
            <input class="form-control mb-4" id="searchInput" type="text" placeholder="Rechercher par nom ou prénom...">
            <table class="table table-bordered" id="etudiantTable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($etudiants)):
                        foreach ($etudiants as $etudiant): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
                                <td><?php echo htmlspecialchars($etudiant['prenom']); ?></td>
                                <td>
                                    <a class="link-secondary" href="mailto:<?php echo htmlspecialchars($etudiant['email']);  ?>">
                                    <?php echo htmlspecialchars($etudiant['email']); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Aucun étudiant trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function confirmationSuppression() {
        ?>
        <div class="container mt-5">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Étudiant supprimé !</h4>
                <p>L'étudiant a bien été supprimé de la base de données.</p>
            </div>
        </div>
        <?php
    }
    
}
