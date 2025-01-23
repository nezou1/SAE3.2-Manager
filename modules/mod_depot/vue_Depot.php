<?php

class VueDepot extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficherDepots($depots, $projetDetails) {
        ?>
        <div class="container">
            <h1>Dépôts pour le projet : <?php echo htmlspecialchars($projetDetails['titre']); ?></h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Descriptif</th>
                        <th>Date Envoyée</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($depots as $depot): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($depot['descriptif']); ?></td>
                            <td><?php echo htmlspecialchars($depot['dateEnvoyee']); ?></td>
                            <td>
                                <a href="public/depots/<?php echo htmlspecialchars($depot['chemin_fichier']); ?>" target="_blank">Voir</a>
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
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php
    }

    public function afficherMessage($message) {
        ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php
    }
}
