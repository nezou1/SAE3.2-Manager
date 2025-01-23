<?php

class VueGroupe extends VueGenerique {

    public function afficherGroupes($groupes, $etudiants) {
        // Déterminer le rôle à partir du paramètre GET
        $role = $_GET['menu'] ?? 'etudiant'; // Par défaut, 'etudiant' si non spécifié
        ?>
        <style>
            .btn-sauge {
                background-color: #91A89B !important;
                color: white !important;
                border: none;
            }
            .btn-sauge:hover {
                background-color: #7D9A89 !important;
            }
            .badge-sauge {
                background-color: #91A89B !important;
                color: white !important;
            }
            .group-list-container {
                max-height: 350px; 
                overflow-y: auto;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 10px;
                background-color: #f9f9f9;
            }
            .section-title {
                font-weight: bold;
                font-size: 1.5rem;
                color: #2c3e50;
                text-transform: uppercase;
                border-bottom: 2px solid #91A89B;
                padding-bottom: 5px;
                margin-bottom: 15px;
            }
        </style>

        <div class="container mt-5">
            <h1 class="text-center mb-4">Gestion des Groupes</h1>

            <div class="row">
                <?php if ($role === 'enseignant'): ?>
                    <!-- Formulaire d'ajout de groupe (enseignant uniquement) -->
                    <div class="col-md-6">
                        <h3 class="section-title">Créer un nouveau groupe</h3>
                        <form method="POST" action="?module=groupe&menu=enseignant&action=add">
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
                            <button type="submit" class="btn btn-sauge">Créer le groupe</button>
                        </form>
                    </div>
                <?php endif; ?>

                <!-- Liste des groupes existants -->
                <div class="<?= $role === 'enseignant' ? 'col-md-6' : 'col-md-12'; ?>">
                    <h3 class="section-title">Groupes existants</h3>
                    <div class="group-list-container">
                        <ul class="list-group">
                            <?php foreach ($groupes as $groupe): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= htmlspecialchars($groupe['nom']); ?>
                                    <span class="badge badge-sauge rounded-pill">
                                        <?= $groupe['modifiable_par_etudiant'] ? "Modifiable" : "Non modifiable"; ?>
                                    </span>
                                    <a href="?module=groupe&menu=<?= $role ?>&action=voir_membres&idGroupe=<?= $groupe['idGroupe'] ?>" class="btn btn-sauge btn-sm">Voir</a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function afficherGroupesEtudiant($groupes) {
        ?>
        <div class="container mt-5">
            <h1 class="text-center mb-4">Mes Groupes</h1>
            <div class="group-list-container">
                <ul class="list-group">
                    <?php foreach ($groupes as $groupe): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= htmlspecialchars($groupe['nom']); ?>
                            <a href="?module=groupe&menu=etudiant&action=voir_membres&idGroupe=<?= $groupe['idGroupe'] ?>" class="btn btn-sauge btn-sm">Voir les membres</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php
    }

    public function afficherMembresGroupe($membres) {
        $role = $_GET['menu'] ?? 'etudiant';
        ?>
        <div class="container mt-5">
            <h1 class="text-center mb-4">Membres du Groupe</h1>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="badge-sauge">
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
            <a href="?module=groupe&menu=<?= $role ?>" class="btn btn-sauge mt-3">Retour</a>
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
