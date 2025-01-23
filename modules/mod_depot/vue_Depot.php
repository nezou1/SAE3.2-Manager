<?php

class VueDepot extends VueGenerique {

    public function afficherDepots($depots, $projetDetails) {
        ?>
        <div class="container mt-5">
            <h1 class="text-center">Dépôts pour le projet : <?php echo htmlspecialchars($projetDetails['titre'] ?? 'Projet inconnu'); ?></h1>

            <form method="POST" action="?module=depot&action=add" enctype="multipart/form-data" class="my-4">
                <input type="hidden" name="idProjet" value="<?= htmlspecialchars($projetDetails['idProjet'] ?? '') ?>">
                <input type="hidden" name="idGroupe" value="<?= htmlspecialchars($_GET['idGroupe'] ?? '') ?>">

                <div class="mb-3">
                    <label for="descriptif" class="form-label">Descriptif du dépôt</label>
                    <input type="text" class="form-control" id="descriptif" name="descriptif" required>
                </div>

                <div class="mb-3">
                    <label for="fichier" class="form-label">Fichier à déposer</label>
                    <input type="file" class="form-control" id="fichier" name="fichier" required>
                </div>
                <button type="submit" class="btn btn-primary"
                    formaction="?module=depot&action=add&projet=<?= htmlspecialchars($_GET['projet'] ?? '') ?>&groupe=<?= htmlspecialchars($_GET['groupe'] ?? '') ?>">
                    Ajouter le dépôt
                </button>
                        
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Descriptif</th>
                        <th>Date Envoyée</th>
                        <th>Fichier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($depots as $depot): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($depot['descriptif'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($depot['dateEnvoyee'] ?? ''); ?></td>
                            <td>
                                <a href="?module=depot&action=download&idRendu=<?= $depot['idRendu']; ?>">
                                    <?= htmlspecialchars($depot['nomFichier'] ?? 'Aucun fichier'); ?>
                                </a>
                            </td>
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
            <?php echo htmlspecialchars($message ?? 'Une erreur est survenue.'); ?>
        </div>
        <?php
    }

    public function afficherMessage($message) {
        ?>
        <div class="alert alert-success text-center my-3">
            <?php echo htmlspecialchars($message ?? 'Opération réussie.'); ?>
        </div>
        <?php
    }
}
?>
