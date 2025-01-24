<?php

class VueRendu extends VueGenerique
{
    public function afficherPageEnseignant($soutenances, $rendus) {
        ?>
        <div class="mt-5">
            <h1>Evaluation</h1>
            <div class="section">
                <h2>Soutenances</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Lieu</th>
                            <th>Heure Début</th>
                            <th>Heure Fin</th>
                            <th>Action</th>
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
                                    <td><?= htmlspecialchars($soutenance['lieu']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['heureDebut']) ?></td>
                                    <td><?= htmlspecialchars($soutenance['heureFin']) ?></td>
                                    <td>
                                        <a href="index.php?module=evaluation&action=evaluerSoutenance&id=<?= $soutenance['idSoutenance'] ?>&menu=enseignant" class="btn btn-primary">Évaluer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="section">
                <h2>Rendus</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>URL</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rendus)): ?>
                            <tr>
                                <td colspan="4">Aucun rendu trouvé.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($rendus as $rendu): ?>
                                <tr>
                                    <td><?= htmlspecialchars($rendu['titre_rendu']) ?></td>
                                    <td><?= htmlspecialchars($rendu['dateEnvoyee']) ?></td>
                                    <td><?= htmlspecialchars($rendu['url_rendu']) ?></td>
                                    <td>
                                        <a href="index.php?module=evaluation&action=evaluerRendu&id=<?= $rendu['idDepot'] ?>&menu=enseignant" class="btn btn-primary">Évaluer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="index.php?module=soutenance" class="btn btn-primary">Ajouter une Soutenance</a>
                <a href="index.php?module=rendu&action=creerDepot&menu=enseignant" class="btn btn-primary">Ajouter un Dépôt</a>
            </div>
        </div>
        <?php
    }

    public function creerDepot() {
        ?>
        <div class="container mt-5">
            <h1>Créer un Dépôt</h1>
            <form method="POST" action="index.php?module=rendu&action=creerDepot">
                <div class="mb-3">
                    <label for="descriptif" class="form-label">Descriptif</label>
                    <input type="text" class="form-control" id="descriptif" name="descriptif" required>
                </div>
                <div class="mb-3">
                    <label for="dateAttendu" class="form-label">Date Attendue</label>
                    <input type="date" class="form-control" id="dateAttendu" name="dateAttendu" required>
                </div>
                <div class="mb-3">
                    <label for="idProjet" class="form-label">ID du Projet</label>
                    <input type="number" class="form-control" id="idProjet" name="idProjet" required>
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
        </div>
        <?php
    }
}
?>