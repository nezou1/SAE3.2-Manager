<?php

class VueDepot extends VueGenerique {

    public function afficherDepots($depots, $projetDetails) {
        ?>
        <div class="container mt-5">
            <h1 class="text-center">Dépôts pour le projet : <?php echo htmlspecialchars($projetDetails['titre']); ?></h1>

            <form method="POST" action="?module=depot&action=add" class="my-4">
                <input type="hidden" name="idProjet" value="<?php echo htmlspecialchars($projetDetails['idProjet']); ?>">

                <div class="mb-3">
                    <label for="descriptif" class="form-label">Descriptif du dépôt</label>
                    <input type="text" class="form-control" id="descriptif" name="descriptif" required>
                </div>

                <button type="submit" class="btn btn-primary">Ajouter le dépôt</button>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Descriptif</th>
                        <th>Date Envoyée</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($depots as $depot): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($depot['descriptif']); ?></td>
                            <td><?php echo htmlspecialchars($depot['dateEnvoyee']); ?></td>
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
