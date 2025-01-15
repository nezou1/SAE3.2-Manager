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
}
