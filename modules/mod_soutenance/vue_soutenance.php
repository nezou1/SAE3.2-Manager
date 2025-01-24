<?php

class VueSoutenance extends VueGenerique{

        public function __construct() {
            parent::__construct();
        }
    
        // Formulaire d'ajout de soutenance
        public function form_ajout() {
            ?>
            <div class="container mt-4">
                <h2 class="text-center mb-4">Ajouter une Soutenance</h2>
                <form action="index.php?menu=enseignant&module=soutenance&action=ajout" method="POST" class="shadow p-4 bg-light rounded">
                    <input type="hidden" name="tokenCSRF" value="<?= $token ?>">
    
                    <div class="mb-3">
                        <label class="form-label">Description:</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label">Date:</label>
                        <input type="date" name="dateSout" class="form-control" required>
                    </div>
    
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Heure Début:</label>
                            <input type="time" name="heureDebut" class="form-control" required>
                        </div>
                        <div class="col">
                            <label class="form-label">Heure Fin:</label>
                            <input type="time" name="heureFin" class="form-control" required>
                        </div>
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label">Lieu:</label>
                        <input type="text" name="lieu" class="form-control" required>
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label">Groupe:</label>
                        <input type="number" name="idGroupe" class="form-control" required>
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label">Projet:</label>
                        <input type="number" name="idProjet" class="form-control" required>
                    </div>
    
                    <button type="submit" class="btn btn-primary w-100">Ajouter</button>
                </form>
            </div>
            <?php
        }
    
        // Message de confirmation après ajout
        public function confirmeAjout() {
            echo "<div class='container mt-4'>";
            echo "<div class='alert alert-success text-center'>Soutenance ajoutée avec succès !</div>";
            echo '<a href="index.php?menu=enseignant&module=soutenance&action=liste" class="btn btn-primary">Retour à la liste des soutenances</a>';
            echo "</div>";
        }
    
        public function get_soutenances($soutenances) {
            ?>
            <div class="container mt-4">
                <h2 class="text-center mb-4">Liste des Soutenances</h2>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Heure Début</th>
                            <th>Heure Fin</th>
                            <th>Lieu</th>
                            <th>ID Groupe</th>
                            <th>ID Projet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($soutenances)): ?>
                            <tr>
                                <td colspan="8" class="text-center">Aucune soutenance trouvée.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($soutenances as $soutenance): ?>
                                <tr>
                                    <td><?= htmlspecialchars($soutenance['idSoutenance']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['description']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['dateSout']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['heureDebut']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['heureFin']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['lieu']) ?></td>
                                    <td><?= isset($soutenance['idGroupe']) ? htmlspecialchars($soutenance['idGroupe']) : 'N/A' ?></td>
                                    <td><?= isset($soutenance['idProjet']) ? htmlspecialchars($soutenance['idProjet']) : 'N/A' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
        
    
        public function mesSoutenances($soutenances) {
            ?>
            <div class="container mt-4">
                <h2 class="text-center mb-4">Mes Soutenances</h2>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Heure Début</th>
                            <th>Heure Fin</th>
                            <th>Lieu</th>
                            <th>Groupe</th>
                            <th>Projet</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($soutenances)): ?>
                            <tr>
                                <td colspan="8" class="text-center">Aucune soutenance trouvée.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($soutenances as $soutenance): ?>
                                <tr>
                                    <td><?= htmlspecialchars($soutenance['idSoutenance']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['description']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['dateSout']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['heureDebut']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['heureFin']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['lieu']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['groupe']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['projet']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
        public function afficherErreur($message) {
            ?>
            <div class="alert alert-danger text-center mt-3">
                <strong>Erreur :</strong> <?= htmlspecialchars($message) ?>
            </div>
            <?php
        }
        

    public function mesSoutenanceEtudiant($soutenances) {
        ?>
        <div class="container mt-5">
            <h1>Mes Soutenances</h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Heure Début</th>
                        <th>Heure Fin</th>
                        <th>Lieu</th>
                        <th>Groupe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($soutenances)): ?>
                        <tr>
                            <td colspan="6">Aucune soutenance trouvée.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($soutenances as $soutenance): ?>
                            <tr>
                                <td><?= htmlspecialchars($soutenance['description']) ?></td>
                                <td><?= htmlspecialchars($soutenance['dateSout']) ?></td>
                                <td><?= htmlspecialchars($soutenance['heureDebut']) ?></td>
                                <td><?= htmlspecialchars($soutenance['heureFin']) ?></td>
                                <td><?= htmlspecialchars($soutenance['lieu']) ?></td>
                                <td><?= htmlspecialchars($soutenance['nom_groupe']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
     
}
?>