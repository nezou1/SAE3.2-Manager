<?php

class VueEvaluation extends VueGenerique
{
    public function __construct() {
        parent::__construct();
    }

    public function afficherEvaluationSoutenance($soutenance) {
        ?>
        <div class="container mt-5">
            <h1 class="mb-4">Évaluation de la Soutenance</h1>
            <form method="POST" action="index.php?module=evaluation&action=soumettreEvaluation">
                <input type="hidden" name="id" value="<?= htmlspecialchars($soutenance['idSoutenance']) ?>">
                <input type="hidden" name="type" value="soutenance">

                <div class="mb-3">
                    <label for="note" class="form-label">Note :</label>
                    <input type="number" class="form-control" id="note" name="note" step="0.1" min="0" max="20" required>
                </div>

                <div class="mb-3">
                    <label for="commentaire" class="form-label">Commentaire :</label>
                    <textarea class="form-control" id="commentaire" name="commentaire" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="coef" class="form-label">Coefficient :</label>
                    <input type="number" step="0.1" class="form-control" id="coef" name="coef" min="0" max="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        </div>
        <?php
    }

    public function afficherEvaluationRendu($rendu) {
        ?>
        <div class="container mt-5">
            <h1 class="mb-4">Évaluation du Rendu</h1>
            <form method="POST" action="index.php?module=evaluation&action=soumettreEvaluation">
                <input type="hidden" name="id" value="<?= htmlspecialchars($rendu['idRendu']) ?>">
                <input type="hidden" name="type" value="rendu">

                <div class="mb-3">
                    <label for="note" class="form-label">Note :</label>
                    <input type="number" class="form-control" id="note" name="note" step="0.1" min="0" max="20" required>
                </div>

                <div class="mb-3">
                    <label for="commentaire" class="form-label">Commentaire :</label>
                    <textarea class="form-control" id="commentaire" name="commentaire" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="coef" class="form-label">Coefficient :</label>
                    <input type="number" step="0.1" class="form-control" id="coef" name="coef" min="0" max="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Soumettre</button>
            </form>
        </div>
        <?php
    }

    public function confirmeEvaluation(){
        ?>
        <div class="container mt-5">
            <h1 class="mb-4">Évaluation soumise</h1>
            <p>Votre évaluation a bien été soumise avec succès.</p>
            <a class="btn btn-primary" href="index.php?module=evaluation">Retour</a>
        </div>
        <?php
    }

    public function afficherNotesEtudiantSoutenance($notes) {
        ?>
        <div class="container mt-5">
            <h1 class="mb-4">Notes des Soutenances</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Soutenance</th>
                        <th>Note</th>
                        <th>Commentaire</th>
                        <th>Coefficient</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($notes)): ?>
                        <?php foreach ($notes as $note): ?>
                            <tr>
                                <td><?= htmlspecialchars($note['description']) ?></td>
                                <td><?= htmlspecialchars($note['note']) ?></td>
                                <td><?= htmlspecialchars($note['commentaire']) ?></td>
                                <td><?= htmlspecialchars($note['coef']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Aucune note disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}
?>
