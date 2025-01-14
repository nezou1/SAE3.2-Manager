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
        <div class="container mt-5">
            <h2 class="mb-4">Liste des étudiants</h2>
            <table class="table table-bordered">
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
