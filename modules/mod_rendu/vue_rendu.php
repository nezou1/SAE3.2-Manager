<?php

class VueRendu extends VueGenerique
{
    public function afficherPageEnseignant($soutenances, $rendus) {
        ?>
        <div class="mt-5">
            <h1>Evaluation</h1>
            <div class="section">
                <h2>Soutenances</h2>
                <table class="table">
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
                                        <a href="index.php?module=evaluation&action=evaluerSoutenance&id=<?= $soutenance['idSoutenance'] ?>" class="btn btn-primary">Évaluer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="section">
                <h2>Rendus</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rendus)): ?>
                            <tr>
                                <td colspan="3">Aucun rendu trouvé.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($rendus as $rendu): ?>
                                <tr>
                                    <td><?= htmlspecialchars($rendu['descriptif']) ?></td>
                                    <td><?= htmlspecialchars($rendu['dateEnvoyee']) ?></td>
                                    <td>
                                        <a href="index.php?module=evaluation&action=evaluerRendu&id=<?= $rendu['idRendu'] ?>" class="btn btn-primary">Évaluer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="index.php?module=soutenance" class="btn btn-primary">Ajouter une Soutenance</a>
                <a href="index.php?module=rendu&action=creerRendu" class="btn btn-primary">Ajouter un Rendu</a>
            </div>
        </div>
        <?php
    }

}
?>
