<?php

class VueSae extends VueGenerique{

    public function __construct () {
		parent::__construct();
	}

	public function mes_saes($saes) {
	?>
		<div class="container">
			<h1 class="text-center mb-4">Mes SAE</h1>
			<div class="container">
				<div class="row">
					<?= $this->get_saes($saes)?>
	<?php				if ($_GET["menu"] == "enseignant") {?>
						<a href="index.php?menu=enseignant&module=sae&action=form_creer_sae">
							<button class="btn btn-primary w-100">Creer une SAE</button>
						</a>
	<?php				}?>
				<div>
			<div>
		</div>
	<?php
	}

	private function get_saes($saes) {
		if ($saes){
			foreach($saes as $sae){
	?>			<div class="col-md-4 w-100 mb-4">
					<a href="index.php?menu=enseignant&module=sae&action=acceder_sae&projet=<?=htmlspecialchars($sae['idProjet'])?>">
						<div class="card text-center">
							<div class="card-body ">
								<h5 class="card-title"><?= htmlspecialchars($sae['titre'])?></h5>
								<p class="card-text">
									Annee : <?= htmlspecialchars($sae['annee'])?><br>
									S<?= htmlspecialchars($sae['semestre'])?>
								</p>
							</div>
						</div>
					</a>
				</div>
<?php		}
		}
		else {
?>			<div class="col-md-4">									
				<p>Vous n'avez aucune SAE pour le moment</p>
			</div>
<?php	}
	}

	public function acceder_sae($sae, $enseignants, $ressources, $groupes, $etudiants, $depots, $soutenances) {
?>		
	<div class="container">
		<!-- Titre du projet -->
		<h1 class="text-center mb-4"><?= htmlspecialchars($sae['titre'])?></h1>

		<!-- Année et semestre -->
		<div class="top-0 start-0 p-3 text-white rounded" style="background-color: #91A89B; color: white; border-radius: 0.375rem;">
			<strong>Année : </strong><?= htmlspecialchars($sae['annee'])?><br>
			<strong>S<?= htmlspecialchars($sae['semestre'])?></strong>
		</div>

		<!-- Description -->
		<div class="mb-4">
			<h3 class="text-center mt-4 mb-4" >Description</h3>
			<textarea class="form-control" rows="5" placeholder="Entrez la description du projet..."
			<?php if($_GET['menu'] == 'etudiant'):?> readonly <?php endif;?>><?= htmlspecialchars($sae['description'])?></textarea>
		</div>

		<!-- Ressources associées -->
		<div class="container mt-4">
			<div class="mb-4">
				<h3 class="text-center mb-4">Ressources</h3>
				<div class="table-responsive border rounded p-3" style="max-height: 400px; background-color: #f8f9fa; overflow-y: auto;">
				<?php if (!empty($ressources)) {?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col">Nom de la Ressource</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody id="ressourceList">
							<?php foreach ($ressources as $index => $ressource): ?>
								<tr>
									<th scope="row"><?php echo $index + 1; ?></th>
									<td>
										<a href="<?= htmlspecialchars($ressource['url']);?>" target="_blank" class="btn btn-link">
											<?= htmlspecialchars($ressource['titre']); ?>
										</a>
									</td>
									<td>
										<form action="index.php?menu=enseignant&module=sae&action=supprimer_ressource&projet=<?=$_GET['projet']?>" method="POST" style="display:inline;">
											<input type="hidden" name="idRessource" value="<?php echo $ressource['idRessource']; ?>">
											<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce groupe ?');">Supprimer</button>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
<?php			}else {?>
					<div class="col-md-4">									
						<p>Vous n'avez ajouté aucune ressource pour le moment</p>
					</div>
<?php			}?>
					<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRessourceModal">Ajouter Ressource</button>
				</div>
			</div>
		</div>	
		

		<!-- Groupes associés -->
		<div class="container mt-4">
			<h3 class="text-center mb-4">Groupes</h3>
			<div class="table-responsive border rounded p-3" style="max-height: 400px; background-color: #f8f9fa; overflow-y: auto;">
				<?php if (!empty($groupes)) {?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nom du Groupe</th>
								<th>Modifiable par Étudiant</th>
								<th>Actions</th> <!-- Colonne pour les actions -->
							</tr>
						</thead>
						<tbody>
							<?php foreach ($groupes as $groupe): ?>
								<tr>
									<td><?php echo htmlspecialchars($groupe['nom']); ?></td>
									<td><?php echo $groupe['modifiable_par_etudiant'] ? "Oui" : "Non"; ?></td>
									<td>
										<form action="index.php?menu=enseignant&module=sae&action=supprimer_groupe&projet=<?=$_GET['projet']?>" method="POST" style="display:inline;">
											<input type="hidden" name="idGroupe" value="<?php echo $groupe['idGroupe']; ?>">
											<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce groupe ?');">Supprimer</button>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
<?php			}else {?>
					<div class="col-md-4">
						<p>Vous n'avez crée aucun groupe pour le moment</p>
					</div>
<?php			}?>	<div class="col-md-4">									
					
				<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGroupModal">Ajouter Groupe</button>
			</div>
		</div>

		<!-- Dépôts à rendre -->
		<div class="container mt-4">
			<h3 class="text-center mb-4">Dépots</h3>
			<div class="table-responsive border rounded p-3" style="max-height: 400px; background-color: #f8f9fa; overflow-y: auto;">
				<?php if (!empty($groupes)) {?>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col"></th>
								<th scope="col">Nom de la Ressource</th>
								<th scope="col">Date de rendu</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody id="ressourceList">
							<?php $i = 0; foreach ($depots as $depot): ?>
								<tr>
									<th scope="row"><?php echo $i + 1; ?></th>
									<td>
										<?= htmlspecialchars($depot['descriptif']); ?>
									</td>
									<td>
										<?= htmlspecialchars($depot['dateAttendu']); ?>
									</td>
									<td>
										<form action="index.php?menu=enseignant&module=sae&action=acceder_rendu&projet=<?=$_GET['projet']?>?>" method="POST" style="display:inline;">
											
											<button type="submit" class="btn btn-danger btn-sm">Rendu(s)</button>
										</form>
										<form action="index.php?menu=enseignant&module=sae&action=supprimer_depot&projet=<?=$_GET['projet']?>" method="POST" style="display:inline;">
											<input type="hidden" name="idDepot" value="<?php echo $depot['idDepot']; ?>">
											<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce dépot ?');">Supprimer</button>
										</form>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
<?php			}else {?>
					<div class="col-md-4">									
						<p>Vous n'avez crée aucun dépot pour le moment</p>
					</div>
<?php			}?>	<div class="col-md-4">	
			</div>

			<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDepotModal">Ajouter Dépôt</button>
		</div>

		<?php if($groupes) {
				$this->mes_soutenances($soutenances);
		}?>
		<!-- Note finale -->
		<div class="mb-4">
			<h4>Note Finale</h4>
			<input type="text" class="form-control" placeholder="Entrez la note finale...">
		</div>
		
	</div>

	<!-- Modal Ajouter Ressource -->
	<div class="modal fade" id="addRessourceModal" tabindex="-1" aria-labelledby="addRessourceModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addRessourceModalLabel">Ajouter Ressource</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="ressourceForm" action="index.php?menu=enseignant&module=sae&action=ajouter_ressource&projet=<?php echo $_GET['projet'] ?>" method="POST" enctype="multipart/form-data">
						<div class="mb-3">
							<label for="ressourceName" class="form-label">Nom de la ressource</label>
							<input type="text" name="ressourceName" id="ressourceName" class="form-control" placeholder="Nom de la ressource">
							<div id="ressourceNameError" class="text-danger d-none"></div>
						</div>
						<!-- Modifiable par les étudiants -->
						<div class="form-check mb-3">
							<input class="form-check-input" type="checkbox" id="mise_en_avant" name="mise_en_avant">
							<label class="form-check-label" for="mise_en_avant">Mettre en avant</label>
						</div>
						<div class="mb-3">
							<label for="ressourceFile" class="form-label">Fichier à télécharger</label>
							<input type="file" name="ressourceFile" id="ressourceFile" class="form-control" accept=".png,.jpeg,.jpg,.pdf,.docx,.xlsx,.txt">
							<div id="ressourceFileError" class="text-danger d-none"></div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
					<input type="submit" class="btn btn-primary" onclick="addRessource(event)"value="Ajouter">
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Ajouter Groupe -->
	<div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="addGroupModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addGroupModalLabel">Ajouter un Groupe</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="addGroupForm" method="POST" action="index.php?menu=enseignant&module=sae&action=ajouter_groupe&projet=<?=$_GET['projet']?>">
						<!-- Nom du groupe -->
						<div class="mb-3">
							<label for="nom_grp" class="form-label">Nom du groupe</label>
							<input type="text" id="nom_grp" name="nom_grp" class="form-control" required>
							<small id="nom_grp_error" class="text-danger d-none"></small>
						</div>

						<!-- Modifiable par les étudiants -->
						<div class="form-check mb-3">
							<input class="form-check-input" type="checkbox" id="modifiable_par_etudiant" name="modifiable_par_etudiant">
							<label class="form-check-label" for="modifiable_par_etudiant">Modifiable par les étudiants</label>
						</div>

						<!-- Liste des étudiants -->
						<div class="mb-3">
							<label for="etudiants" class="form-label">Ajouter des étudiants</label>
							<div class="border p-2 rounded overflow-auto" style="height: 220px; background-color: #f8f9fa;">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th></th> <!-- Colonne pour les cases à cocher -->
											<th>Nom</th>
											<th>Prénom</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($etudiants as $etudiant): ?>
											<tr>
												<td>
													<input class="form-check-input" type="checkbox" id="etudiant-<?php echo $etudiant['idEtud']; ?>" name="etudiants[]" value="<?php echo $etudiant['idEtud']; ?>">
												</td>
												<td>
													<?php echo htmlspecialchars($etudiant['nom']); ?>
												</td>
												<td>
													<?php echo htmlspecialchars($etudiant['prenom']); ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<small id="etudiants_error" class="text-danger d-none"></small>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<input type="submit" class="btn btn-primary" onclick="addGroupe(event)"value="Ajouter">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>



	<!-- Modal Ajouter Dépôt -->
	<div class="modal fade" id="addDepotModal" tabindex="-1" aria-labelledby="addDepotModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addDepotModalLabel">Ajouter Dépôt</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="index.php?menu=enseignant&module=sae&action=ajouter_depot&projet=<?= $_GET['projet']?>" id="depotForm">
						<div class="mb-3">
							<label for="description_depot" class="form-label">Description</label>
							<textarea class="form-control" id="description_depot" name="description_depot" required></textarea>
							<small id="description_depot_error" class="text-danger d-none"></small>
						</div>
						<div class="mb-3">
							<label for="date_depot" class="form-label">Date de rendu</label>
							<input type="date" class="form-control" id="date_depot" name="date_depot" required>
							<small id="date_depot_error" class="text-danger d-none"></small>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
							<button type="button" class="btn btn-primary" onclick="addDepot(event)">Ajouter</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Ajouter Soutenance -->
	<div class="modal fade" id="addSoutenanceModal" tabindex="-1" aria-labelledby="addSoutenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSoutenanceModalLabel">Ajouter Soutenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire de la soutenance -->
                <form id=soutenanceForm>
                    <!-- Nom du Groupe -->
                    <div class="mb-3">
                        <label for="soutenance_nom_grp" class="form-label">Nom du Groupe</label>
						<select id="soutenance_nom_grp" class="form-select" required>
							<option value="">Choisir un groupe</option>
							<?php foreach ($groupes as $groupe): ?>
								<option value="<?=htmlspecialchars($groupe['nom']) ?>">
									<?=htmlspecialchars($groupe['nom']) ?>
								</option>
							<?php endforeach; ?>
						</select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="soutenance_titre_sae" class="form-label">Titre de la SAE</label>
                        <select id="soutenance_titre_sae" class="form-select" required>
                            <option value="">Choisir un titre</option>
                            <!-- Options des SAE (les options doivent être générées dynamiquement) -->
                            <!-- <?php /*foreach ($saes as $sae): ?>
								<option value="<?=htmlspecialchars($sae['titre']) ?>">
									<?=htmlspecialchars($sae['titre']) ?>
								</option>
							<?php endforeach; */?> -->
							<option value="sae1">SAE 1</option>
                            <option value="sae2">SAE 2</option>
                            <option value="sae3">SAE 3</option>
                        </select>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="soutenance_description" class="form-label">Description</label>
                        <textarea id="soutenance_description" class="form-control" placeholder="Description de la soutenance" required></textarea>
                    </div>
                    
                    <!-- Date de la soutenance -->
                    <div class="mb-3">
                        <label for="soutenance_dateSout" class="form-label">Date de Soutenance</label>
                        <input type="date" id="soutenance_dateSout" class="form-control" required>
                    </div>
                    
                    <!-- Lieu de la soutenance -->
                    <div class="mb-3">
                        <label for="soutenance_lieu" class="form-label">Lieu de la Soutenance</label>
                        <input type="text" id="soutenance_lieu" class="form-control" placeholder="Lieu de la soutenance" required>
                    </div>
                    
                    <!-- Heure de début -->
                    <div class="mb-3">
                        <label for="soutenance_heure_debut" class="form-label">Heure de Début</label>
                        <input type="time" id="soutenance_heure_debut" class="form-control" required>
                    </div>
                    
                    <!-- Heure de fin -->
                    <div class="mb-3">
                        <label for="soutenance_heure_fin" class="form-label">Heure de Fin</label>
                        <input type="time" id="soutenance_heure_fin" class="form-control" required>
                    </div>
                    
                    <!-- Jurys -->
                    <div class="mb-3">
                        <label for="soutenance_jurys" class="form-label">Sélectionner les Jurys</label>
                        <select id="soutenance_jurys" class="form-select" multiple required>
                            <!-- Options des jurys (les options doivent être générées dynamiquement) -->
                            <option value="jury1@example.com">Jury 1</option>
                            <option value="jury2@example.com">Jury 2</option>
                            <option value="jury3@example.com">Jury 3</option>
                            <!-- Ajoute d'autres jurys ici -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="addSoutenance()">Ajouter</button>
            </div>
        </div>
    </div>
</div>

<script src="../assets/script/scriptModalWindows.js"></script>

<?php
	}



// VUE SOUTENANCE

		private function mes_soutenances($soutenances){
?>			<div class="mb-4">
<?php			if (!empty($soutenances)){
					$this->tableau_soutenances(htmlspecialchars($soutenances));
				}else {
?>					<div class="col-md-4">									
						<p>Vous n'avez aucune soutenances pour le moment</p>
					</div>
<?php	 		}?>
				<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSoutenanceModal">Ajouter une Soutenance</button>
			</div>
<?php	}

		private function tableau_soutenances($soutenances) {
?>			<!-- Tableau des soutenances -->
			<div>
				<h4>Soutenances</h4>
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
								<td><?= htmlspecialchars($soutenance['titre_sae']) ?></td>
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
			</div>
<?php	}

// FORMULAIRE CREER SAE

	public function form_creer_sae($erreurs) {
?>
        <div class="container">
			<h1 class="text-center mb-4">Mes SAE</h1>
            <div class="row">
				<div class="form-container">
					<!-- Formulaire d'ajout de SAE -->
					<form action="index.php?menu=enseignant&module=sae&action=creer_sae" method="POST" enctype="multipart/form-data" nonvalide>
						<!-- Titre -->
						<div class="mb-3">
							<label for="titre" class="form-label">Titre</label>
							<input type="text" id="titre" name="titre" class="form-control" placeholder="Titre" >
							<?php if (isset($erreurs['titre'])): ?>
								<small class="error-message"><?= $erreurs['titre'] ?></small>
							<?php endif; ?>
						</div>
						<!-- Description -->
						<div class="mb-3">
							<label for="description" class="form-label">Description</label>
							<input type="text" id="description" name="description" class="form-control" placeholder="Description" >
							<?php if (isset($erreurs['description'])): ?>
								<small class="error-message"><?= $erreurs['description'] ?></small>
							<?php endif; ?>
						</div>
						<!-- Annee -->
						<div class="mb-3">
							<label for="annee" class="form-label">Annee</label>
							<input type="number" min="0" id="annee" name="annee" class="form-control" placeholder="Annee" >
							<?php if (isset($erreurs['annee'])): ?>
								<small class="error-message"><?= $erreurs['annee'] ?></small>
							<?php endif; ?>
						</div>
						<script>
							const annee_courante = new Date().getFullYear();
							document.getElementById('annee').setAttribute('min', annee_courante);
						</script>
						<!-- Semestre -->
						<div class="mb-3">
							<label for="semestre" class="form-label">Semestre</label>
							<select name="semestre[]" id="semestre" class="form-select selectpicker" data-live-search="true" data-selected-text-format="count" >
								<option value="" disabled selected>Sélectionner</option>
									<?php for ($semestre = 1 ; $semestre <= 6 ; $semestre++): ?>
										<option value="<?= $semestre?>">
											<?= $semestre ?>
										</option>
									<?php endfor; ?>
								</select>
							<?php if (isset($erreurs['semestre'])): ?>
								<small class="error-message"><?= $erreurs['semestre'] ?></small>
							<?php endif; ?>
						</div>
						<div class="d-flex justify-content-between">
							<input type="submit" class="btn btn-primary" value="Créer">
						</div>
					</form>
            </div>
        </div>
<?php
	}

	public function confirmeAjout() {
?>		<div class="container d-flex justify-content-center align-items-center vh-100">
			<div class="card shadow-lg p-4 text-center">
				<div class="card-body">
					<h1 class="text-success">Confirmation réussie</h1>
					<p class="mt-3 mb-4">Votre SAE a été ajoutée avec succès !<br> Vous allez être redirigé vers la page d'accueil</p>
				</div>
			</div>
		</div>
		<script>
			setTimeout(() => {
				window.location.href = "index.php?menu=enseignant&module=sae&action=mes_saes"; // Remplace "index.html" par l'URL de la page d'accueil
			}, 3000);
		</script>
<?php
	}

	private function vue_date_depot() {
?>		<!-- Date de dépôt -->
		<div>
			<label for="date_depot" class="form-label">Date de Dépôt</label>
			<input type="date" id="date_depot" name="date_depot" class="form-input" placeholder="Date de Dépôt" required>
			<?php if (isset($erreurs['date_depot'])): ?>
				<small class="error-message"><?= $erreurs['date_depot'] ?></small>
			<?php endif; ?>
		</div>
		<script>
			const date_courante = new Date().toISOString().split('T')[0];
			document.getElementById('date_depot').setAttribute('min', date_courante);
		</script>
<?php
	}

	private function vue_intervenants($liste) {
?>  	<div class="mb-3">
			<label for="intervenants" class="form-label">Intervenants</label>

			<?php if (!empty($liste)) : ?>
				<div class="custom-select-container">
					<!-- Dropdown -->
					<div class="form-control multiselect dropdown-toggle" id="multiSelectDropdown" data-bs-toggle="dropdown" aria-expanded="false">
						<span class="text-muted" id="placeholder_intervenants">Sélectionner</span>
						<input type="hidden" name="intervenants[]" id="intervenants" class="form-input">
					</div>
					<!-- Dropdown menu -->
					<ul class="dropdown-menu w-100" id="dropdownOptions">
						<?php foreach ($liste as $intervenant): ?>
							<li>
								<label class="dropdown-item">
									<input type="checkbox" class="intervenant-checkbox" value="<?=htmlspecialchars($intervenant['email']) ?>">
									<?=htmlspecialchars($intervenant['email']) ?>
								</label>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<!-- Script to handle selections -->
				<script>
					document.addEventListener('DOMContentLoaded', function () {
						const checkboxes = document.querySelectorAll('.intervenant-checkbox');
						const inputField = document.getElementById('intervenants');
						const placeholder = document.getElementById('placeholder_intervenants');

						function updateSelections() {
							// Récupère toutes les valeurs sélectionnées
							const selected = Array.from(checkboxes)
								.filter(cb => cb.checked) // Filtrer uniquement les cases cochées
								.map(cb => cb.value);    // Obtenir leurs valeurs
							
							// Met à jour l'input caché
							inputField.value = selected.join(','); // Join pour soumission via formulaire
							
							// Met à jour le placeholder
							placeholder.textContent = selected.length > 0 ? selected.join(', ') : 'Sélectionner';
						}
						// Ajouter un événement change à chaque case
						checkboxes.forEach(checkbox => {
							checkbox.addEventListener('change', updateSelections);
						});
					});
				</script>
			<?php else : ?>
				<p>Aucun enseignant</p>
			<?php endif ?>
		</div>
<?php
	}

	private function vue_depot_ressources() {
?>		<!-- Ressources -->	
		<div class="mb-3">
			<label for="ressources" class="form-label">Ressources</label>

			<div class="container mt-5">
			<div id="drop-area" class="drop-area border border-secondary rounded p-4 text-center">
                <p>Glissez vos fichiers ici ou <button type="button" id="file-input-button" class="btn btn-link">Déposer une Ressource</button></p>
                <input type="file" name="ressources[]" id="file-input" multiple style="display: none;">
            </div>
				<table id="file-table" class="table table-bordered mt-4" style="display: none;">
                <thead class="thead-light">
						<tr>
							<th>Nom du Fichier</th>
							<th>Type</th>
							<th>Mettre en avant</th>
                        	<th>Action</th>
						</tr>
					</thead>
					<tbody id="file-table-body"></tbody>
				</table>
				<input type="hidden" name="fichiers_mise_en_avant[]" id="fichiers_mise_en_avant">
        		<input type="hidden" name="fichiers_etat[]" id="fichiers_etat">
			</div>
		</div>
		<script src="../assets/script/scriptDepot.js"></script>
<?php
	}
}
?>