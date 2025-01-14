<?php

class VueGroupe extends VueGenerique {

    public function afficherGroupes($groupes) {
        ?>
        <div class="container mt-5">
            <h1 class="text-center">Gestion des Groupes</h1>

            <!-- Formulaire pour ajouter un groupe -->
            <form method="POST" action="?module=groupe&action=add" class="my-4">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du groupe</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="modifiable_par_etudiant" name="modifiable_par_etudiant">
                    <label class="form-check-label" for="modifiable_par_etudiant">
                        Modifiable par les étudiants
                    </label>
                </div>
                <button type="submit" class="btn btn-dark">Créer le groupe</button>
            </form>

            <!-- Liste des groupes -->
            <h2 class="mt-5">Liste des Groupes</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Modifiable par les étudiants</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($groupes as $groupe): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($groupe['nom']); ?></td>
                            <td><?php echo $groupe['modifiable_par_etudiant'] ? 'Oui' : 'Non'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function afficherErreur($message) {
        ?>
        <div class="alert alert-danger text-center my-3">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php
    }

    public function afficherMessage($message) {
        ?>
        <div class="alert alert-success text-center my-3">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php
    }
}
