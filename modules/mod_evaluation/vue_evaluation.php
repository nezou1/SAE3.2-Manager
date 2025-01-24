<?php

class VueEvaluation extends VueGenerique
{
    public function afficherEvaluationSoutenance($soutenance) {
        ?>
        <form action="./index.php?module=evaluation&action=evaluerSoutenance" method="POST">
        <div class="container mt-5">
            <h1>Évaluation de la Soutenance</h1>
            <form method="POST" action="index.php?module=evaluation&action=soumettreEvaluation">
                <input type="hidden" name="id" value="<?= $soutenance['idSoutenance'] ?>">
                <input type="hidden" name="type" value="soutenance">
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <input type="number" class="form-control" id="note" name="note" required>
                </div>
                <div class="mb-3">
                    <label for="commentaire" class="form-label">Commentaire</label>
                    <textarea class="form-control" id="commentaire" name="commentaire" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="coef" class="form-label">Coefficient</label>
                    <input type="number" step="0.1" class="form-control" id="coef" name="coef" required>
                </div>
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        </div>
        </form>
        <?php
    }

    public function afficherEvaluationRendu($rendu) {
        ?>
        <form action="./index.php?module=evaluation&action=evaluerRendu" method="POST">
        <div class="container mt-5">
            <h1>Évaluation du Rendu</h1>
            <form method="POST" action="index.php?module=evaluation&action=soumettreEvaluation">
                <input type="hidden" name="type" value="rendu">
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <input type="number" class="form-control" id="note" name="note" required>
                </div>
                <div class="mb-3">
                    <label for="commentaire" class="form-label">Commentaire</label>
                    <textarea class="form-control" id="commentaire" name="commentaire" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="coef" class="form-label">Coefficient</label>
                    <input type="number" step="0.1" class="form-control" id="coef" name="coef" required>
                </div>
                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        </div>
        </form>
        <?php
    }

    public function confirmeEvaluation(){
        ?>
        <div class="container mt-5">
            <h1>Évaluation soumise</h1>
            <p>Votre évaluation a bien été soumise.</p>
        </div>
        <?php
    }

    public function afficherNotesEtudiantSoutenance($notes) {
        ?>
        <div class="container mt-5">
            <h1>Notes des Soutenances</h1>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Soutenance</th>
                        <th>Note</th>
                        <th>Commentaire</th>
                        <th>Coefficient</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($notes)): ?>
                        <tr>
                            <td colspan="4">Aucune note trouvée.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($notes as $note): ?>
                            <tr>
                                <td><?= htmlspecialchars($note['description']) ?></td>
                                <td><?= htmlspecialchars($note['note']) ?></td>
                                <td><?= htmlspecialchars($note['commentaire']) ?></td>
                                <td><?= htmlspecialchars($note['coef']) ?></td>
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