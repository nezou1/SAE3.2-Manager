<?php

class VueGroupe extends VueGenerique {

    public function afficherGroupes($groupes, $etudiants, $message = null) {
        ?>
        <div style="margin: 20px auto; width: 90%; font-family: Arial, sans-serif; display: flex; flex-direction: column; gap: 20px;">
            <!-- Message de succès -->
            <?php if ($message): ?>
                <div style="padding: 10px; border: 1px solid #91A89B; background-color: #DFF2BF; color: #91A89B; border-radius: 5px; display: flex; justify-content: space-between; align-items: center;">
                    <span><?php echo htmlspecialchars($message); ?></span>
                    <button onclick="this.parentElement.style.display='none'" style="background: none; border: none; font-weight: bold; cursor: pointer;">X</button>
                </div>
            <?php endif; ?>

            <div style="display: flex; gap: 20px; justify-content: space-between;">
                <!-- Formulaire pour ajouter un groupe -->
                <div style="flex: 1; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; height: 450px; display: flex; flex-direction: column;">
                    <h3 style="text-align: center; margin-bottom: 20px;">Ajouter un Groupe</h3>
                    <form method="POST" action="?module=groupe&action=add" style="display: flex; flex-direction: column; gap: 15px; flex-grow: 1;">
                        <div style="flex-shrink: 0;">
                            <label for="nom" style="font-weight: bold; display: block; margin-bottom: 5px;">Nom du groupe</label>
                            <input type="text" id="nom" name="nom" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>
                        <div style="flex-shrink: 0;">
                            <input type="checkbox" id="modifiable_par_etudiant" name="modifiable_par_etudiant" style="margin-right: 5px;">
                            <label for="modifiable_par_etudiant" style="font-weight: bold;">Modifiable par les étudiants</label>
                        </div>
                        <div style="flex-grow: 1;">
                            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Ajouter des étudiants</label>
                            <div style="height: 220px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; border-radius: 5px; background-color: #fff;">
                                <?php foreach ($etudiants as $etudiant): ?>
                                    <div style="display: flex; align-items: center; margin-bottom: 5px;">
                                        <input type="checkbox" id="etudiant-<?php echo $etudiant['idEtud']; ?>" name="etudiants[]" value="<?php echo $etudiant['idEtud']; ?>" style="margin-right: 10px;">
                                        <label for="etudiant-<?php echo $etudiant['idEtud']; ?>" style="cursor: pointer;">
                                            <?php echo htmlspecialchars($etudiant['nom'] . " " . $etudiant['prenom']); ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div style="flex-shrink: 0; text-align: center;">
                            <button type="submit" style="width: 90%; padding: 8px; border: none; background-color: #91A89B; color: white; border-radius: 5px; font-size: 14px; cursor: pointer;">Créer le groupe</button>
                        </div>
                    </form>
                </div>

                <div style="flex: 1; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9; height: 450px; display: flex; flex-direction: column;">
                    <h3 style="text-align: center; margin-bottom: 20px;">Groupes créés</h3>
                    <div style="max-height: 400px; overflow-y: auto; border: 1px solid #ccc; border-radius: 5px; background-color: #fff;">
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <?php foreach ($groupes as $groupe): ?>
                                <li style="padding: 10px; border-bottom: 1px solid #ccc;">
                                    <?php echo htmlspecialchars($groupe['nom']) . " - " . ($groupe['modifiable_par_etudiant'] ? "Oui" : "Non"); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function affichageGroupeEtudiant($groupes) {
        ?>
        <div class="container mt-5">
            <h1 class="text-center">Gestionnaire de Groupe</h1>
            <div class="search-bar mb-4">
                <input class="form-control" type="text" id="searchGroup" placeholder="Rechercher un groupe...">
            </div>
            <div class="row" id="groupContainer">
                <?php foreach ($groupes as $groupe): ?>
                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($groupe['nom']) ?></h5>
                                <p class="card-text">
                                    <strong>Collègues :</strong>
                                    <ul>
                                        <?php foreach ($groupe['collegues'] as $collegue): ?>
                                            <li><?= htmlspecialchars($collegue) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <strong>Projet :</strong> <?= htmlspecialchars($groupe['projet']) ?>
                                </p>
                                <a href="index.php?module=groupe&action=voir&id=<?= htmlspecialchars($groupe['id']) ?>" class="btn btn-primary">Voir plus</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <script>
            document.getElementById('searchGroup').addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const groups = document.querySelectorAll('#groupContainer .card');
                groups.forEach(group => {
                    const groupName = group.querySelector('.card-title').textContent.toLowerCase();
                    if (groupName.includes(searchValue)) {
                        group.parentElement.style.display = '';
                    } else {
                        group.parentElement.style.display = 'none';
                    }
                });
            });
        </script>
        <?php
    }


}
