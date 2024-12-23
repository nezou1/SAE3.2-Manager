<?php

class VueSoutenance extends VueGenerique{

    public function __construct () {
		parent::__construct();
	}

    public function get_soutenances($soutenances) {
    ?>
        <section>
            <h1>Soutenances</h1>
            <?= $this->get_table_soutenance($soutenances)?>
            <a href="index.php?module=soutenance&action=form_ajout">
                <button class="btn btn-primary w-100">Ajouter une Soutenance</button>
            </a>
            </div>
            </div> 
        </section>
<?php
    }
    public function get_liste_soutenances($soutenances) {
    ?>      
        <section>
            <?= $this->get_table_soutenance($soutenances)?>
            </div>
            </div>
        </section>        
    <?php
        }

    public function get_table_soutenance($soutenances) {
?>      
        <!-- Liste des soutenances -->
        <div class="col-md-6">
            <div class="table-container">
                <!-- <h3>Liste des soutenances</h3> -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Groupe</th>
                            <th>Description</th>
                            <th>SAE</th>
                            <th>Date</th>
                            <th>De</th>
                            <th>À</th>
                            <th>Lieu</th>
                            <th>Jurys</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($soutenances as $soutenance): ?>
                            <tr>
                                <td><?= htmlspecialchars($soutenance['nom_groupe']) ?></td>
                                <td><?= htmlspecialchars($soutenance['description']) ?></td>
                                <td><?= htmlspecialchars($soutenance['sae']) ?></td>
                                <td><?= htmlspecialchars($soutenance['dateSout']) ?></td>
                                <td><?= htmlspecialchars($soutenance['heureDebut']) ?></td>
                                <td><?= htmlspecialchars($soutenance['heureFin']) ?></td>
                                <td><?= htmlspecialchars($soutenance['lieu']) ?></td>
                                <td>
                                    <div class="jury-container">
                                        <button class="toggle-jurys">
                                            <?=htmlspecialchars($soutenance['jurys'][0])?>
                                        </button>
                                        <ul class="jury-list hidden">
                                            <?php foreach ($soutenance['jurys'] as $jury): ?>
                                                <li><?= htmlspecialchars($jury) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
           
<?php   }
    

    public function form_ajout($errors) {
        ?>
        <div class="container">
            <div class="row">
                <!-- Formulaire d'ajout de soutenance -->
                <div class="col-md-6">
                    <div class="form-container">
                        <h3>Ajouter une Soutenance</h3>
                            <form action="index.php?module=soutenance&action=ajout" method="POST" novalidate>
                            <!-- Nom du Groupe -->
                            <div class="mb-3">
                                <label for="nom_groupe" class="form-label">Nom du Groupe</label>
                                <input type="text" id="nom_groupe" name="nom_groupe" class="form-control" placeholder="Nom du Groupe" required>
                                <?php if (isset($errors['nom_groupe'])): ?>
                                    <small class="error-message"><?= $errors['nom_groupe'] ?></small>
                                <?php endif; ?>
                            </div>
                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" id="description" name="description" class="form-control" placeholder="Description" required>
                                <?php if (isset($errors['description'])): ?>
                                    <small class="error-message" id="description_error"></small>
                                <?php endif; ?>
                            </div>
                            <!-- SAE -->
                            <div class="mb-3">
                                <label for="sae" class="form-label">SAE</label>
                                <input type="text" id="sae" name="sae" class="form-control" placeholder="SAE" required>
                                <?php if (isset($errors['sae'])): ?>
                                    <small class="error-message" id="sae_error"></small>
                                <?php endif; ?>
                            </div>
                            <!-- Date -->
                            <div class="mb-3">
                                <label for="dateSout" class="form-label">Date</label>
                                <input type="date" id="dateSout" name="dateSout" class="form-control" placeholder="Date" required>
                                <?php if (isset($errors['dateSout'])): ?>
                                    <small class="error-message" id="dateSout_error"></small>
                                <?php endif; ?>
                            </div>
                            <!-- De -->
                            <div class="mb-3">
                                <label for="heureDebut" class="form-label">De</label>
                                <input type="time" id="heureDebut" name="heureDebut" class="form-control" placeholder="De" required>
                                <?php if (isset($errors['heureDebut'])): ?>
                                    <small class="error-message" id="heureDebut_error"></small>
                                <?php endif; ?>
                            </div>
                            <!-- À -->
                            <div class="mb-3">
                                <label for="heureFin" class="form-label">À</label>
                                <input type="time" id="heureFin" name="heureFin" class="form-control" placeholder="À" required>
                                <?php if (isset($errors['heureFin'])): ?>
                                    <small class="error-message" id="heureFin_error"></small>
                                <?php endif; ?>
                            </div>
                            <!-- Lieu -->
                            <div class="mb-3">
                                <label for="lieu" class="form-label">Lieu</label>
                                <input type="text" id="lieu" name="lieu" class="form-control" placeholder="Lieu" required>
                                <?php if (isset($errors['lieu'])): ?>
                                    <small class="error-message" id="lieu_error"></small>
                                <?php endif; ?>
                            </div>
                            <!-- Jurys -->
                            <div class="mb-3">
                                <label for="jurys">Jurys :</label>
                                <select name="jurys[]" id="jurys" multiple>
                                    <?php foreach ($jurys as $jury): ?>
                                        <option value="<?= htmlspecialchars($jury['idEns']) ?>">
                                            <?= htmlspecialchars($jury['email']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($errors['jurys'])): ?>
                                    <small class="error-message" id="jurys_error"></small>
                                <?php endif; ?>
                            </div>
                            <input type="submit" class="btn btn-primary w-100" value="Ajouter">
                    </form>
                </div>
            </div>
        </div>
<?php
    }


    public function confirmeAjout() {
        ?>
        <div class="container mt-5">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Ajout réussi !</h4>
                <p>La soutenance a été ajoutée avec succès dans le système.</p>
                <hr>
                <p class="mb-0">
                    <a href="index.php?module=soutenance&action=liste" class="btn btn-primary">Retour à la liste des soutenances</a>
                </p>
            </div>
        </div>
        <?php
    }
}
?>