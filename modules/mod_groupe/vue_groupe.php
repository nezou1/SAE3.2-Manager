<?php

class VueGroupe extends VueGenerique {

    public function afficherGroupes($groupes, $etudiants) {
        ?>
        <div class="container mt-5">
            <h1 class="text-center mb-4">Gestion des Groupes</h1>

            <div class="row">
                <!-- Formulaire d'ajout de groupe -->
                <div class="col-md-6">
                    <h3>Créer un nouveau groupe</h3>
                    <form method="POST" action="?module=groupe&action=add">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du groupe</label>
                            <input type="text" id="nom" name="nom" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="modifiable_par_etudiant" name="modifiable_par_etudiant">
                            <label class="form-check-label" for="modifiable_par_etudiant">Modifiable par les étudiants</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sélectionner les étudiants :</label>
                            <div class="border p-2" style="max-height: 200px; overflow-y: auto;">
                                <?php foreach ($etudiants as $etudiant): ?>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="etudiant-<?= $etudiant['idEtud']; ?>" name="etudiants[]" value="<?= $etudiant['idEtud']; ?>">
                                        <label class="form-check-label" for="etudiant-<?= $etudiant['idEtud']; ?>">
                                            <?= htmlspecialchars($etudiant['nom'] . ' ' . $etudiant['prenom']); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Créer le groupe</button>
                    </form>
                </div>

                <!-- Liste des groupes existants -->
                <div class="col-md-6">
                    <h3>Groupes existants</h3>
                    <ul class="list-group">
                        <?php foreach ($groupes as $groupe): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= htmlspecialchars($groupe['nom']); ?>
                                <span class="badge bg-primary rounded-pill">
                                    <?= $groupe['modifiable_par_etudiant'] ? "Modifiable" : "Non modifiable"; ?>
                                </span>
                                <a href="?module=groupe&action=voir_membres&idGroupe=<?= $groupe['idGroupe'] ?>" class="btn btn-info btn-sm">Voir</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }

    public function afficherGroupesEtudiant($groupes) {
        ?>
        <div class="container mt-5">
            <h1 class="text-center mb-4">Mes Groupes</h1>
            <ul class="list-group">
                <?php foreach ($groupes as $groupe): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($groupe['nom']); ?>
                        <a href="?module=groupe&action=voir_membres&idGroupe=<?= $groupe['idGroupe'] ?>" class="btn btn-primary btn-sm">Voir les membres</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }

    public function afficherMembresGroupe($membres) {
        ?>
        <div class="container mt-5">
            <h1 class="text-center mb-4">Membres du Groupe</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($membres as $membre): ?>
                            <tr>
                                <td><?= htmlspecialchars($membre['nom']) ?></td>
                                <td><?= htmlspecialchars($membre['prenom']) ?></td>
                                <td><?= htmlspecialchars($membre['email']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <a href="?module=groupe&action=mes_groupes" class="btn btn-secondary mt-3">Retour</a>
        </div>
        <?php
    }

    public function afficherErreur($message) {
        ?>
        <div class="container mt-5">
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
        </div>
        <?php
    }

    public function afficherMessage($message) {
        ?>
        <div class="container mt-5">
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
        </div>
        <?php
    }
}
?>
