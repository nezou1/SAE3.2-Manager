<?php

class VueSae extends VueGenerique{

    public function __construct () {
		parent::__construct();
	}

	public function mes_saes($saes) {
	?>
		<h1>Mes SAE</h1>
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
	<?php
	}

	private function get_saes($saes) {
		if ($saes){
			foreach($saes as $sae){
	?>			<div class="col-md-4">
					<a href="index.php?menu=enseignant&module=sae&action=acceder_sae&projet=<?=htmlspecialchars($sae)?>">
						<div class="card">
							<!-- <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Bangkok"> -->
							<div class="card-body">
								<h5 class="card-title"><?= htmlspecialchars($sae['titre'])?></h5>
								<p class="card-text">
									Annee : <?= htmlspecialchars($sae['annee'])?><br>
									S<?= htmlspecialchars($sae['semestre'])?>
								</p>
	<!-- <?php						if ($_GET["menu"] == "enseignant") { ?>
									<a href="index.php?module=sae&action=modifier_sae&projet=<?=htmlspecialchars($sae)?>" class="btn btn-primary">Modifier</a>
	<?php						} ?> -->
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

	public function acceder_sae($sae) {
?>		
	<!-- Section principale -->
	<div class="hero">
			<h1>NOM DE LA SAE</h1>
			<div class="description-container">
				<p class="description">courte description</p>
			</div>
		</div>

		<!-- Section des cercles -->
		<div class="circles">
			<div class="circle">Cours</div>
			<div class="circle">Ressource</div>
			<div class="circle">Dépôt</div>
		</div>
<?php
	}

	public function form_creer_sae($liste_enseignant, $erreurs) {
?>
        <h1>Créer une SAE</h1>
        <div class="container">
            <div class="row">
                <!-- Formulaire d'ajout de SAE -->
                <section class="col-md-6">
                    <div class="form-container">
						<form action="index.php?menu=enseignant&module=sae&action=creer_sae" method="POST" enctype="multipart/form-data"> <!--nonvalide -->
							<!-- Titre -->
							<div class="mb-3">
								<label for="titre" class="form-label">Titre</label>
								<input type="text" id="titre" name="titre" class="form-control" placeholder="Titre" required>
								<?php if (isset($erreurs['titre'])): ?>
									<small class="error-message"><?= $erreurs['titre'] ?></small>
								<?php endif; ?>
							</div>
							<!-- Description -->
							<div class="mb-3">
								<label for="description" class="form-label">Description</label>
								<input type="text" id="description" name="description" class="form-control" placeholder="Description" required>
								<?php if (isset($erreurs['description'])): ?>
									<small class="error-message"><?= $erreurs['description'] ?></small>
								<?php endif; ?>
							</div>
							<!-- Semestre -->
							<div class="mb-3">
								<label for="semestre" class="form-label">Semestre</label>
								<select name="semestre[]" id="semestre" class="form-select selectpicker" data-live-search="true" data-selected-text-format="count" required>
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
<?php 						$this->vue_annee();
							$this->vue_date_depot();
							$this->vue_intervenants($liste_enseignant);
							$this->vue_depot_ressources();
?>							
							<div class="d-flex justify-content-between">
								<input type="submit" class="btn btn-primary" value="Créer">
							</div>
						</form>
                </section>
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
					<!-- <div class="d-flex justify-content-center gap-3">
						<a href="index.html" class="btn btn-primary">Retour à l'accueil</a>
						<a href="action-suivante.html" class="btn btn-success">Poursuivre</a>
					</div> -->
				</div>
			</div>
		</div>
		<script>
			setTimeout(() => {
				window.location.href = "index.php?menu=enseignant&module=dashboard"; // Remplace "index.html" par l'URL de la page d'accueil
			}, 3000);
		</script>
<?php
	}

	private function vue_annee() {
?>		<!-- Annee -->
		<div class="mb-3">
			<label for="annee" class="form-label">Annee</label>
			<input type="number" min="0" id="annee" name="annee" class="form-control" placeholder="Annee" required>
			<?php if (isset($erreurs['annee'])): ?>
				<small class="error-message"><?= $erreurs['annee'] ?></small>
			<?php endif; ?>
		</div>
		<script>
			const annee_courante = new Date().getFullYear();
			document.getElementById('annee').setAttribute('min', annee_courante);
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
					<div class="form-control multiselect dropdown-toggle" id="multiSelectDropdown" data-bs-toggle="dropdown" aria-expanded="false">
						<span class="text-muted" id="placeholder_intervenants">Sélectionner</span>
					</div>
					<ul class="dropdown-menu w-100" id="dropdownOptions">
						<?php foreach ($liste as $intervenant): ?>
							<li>
								<label class="dropdown-item"><input type="checkbox" value="<?=htmlspecialchars($intervenant['email'])?>">
								<?=htmlspecialchars($intervenant['email'])?>	
								</label>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php else : ?>
						<p>Aucun enseignant</p>
				<?php endif?>
		</div>
		<script src="../assets/script/scriptSelect.js"></script>
<?php
	} 

	private function vue_depot_ressources() {
?>		<!-- Ressources -->	
		<div class="mb-3">
			<label for="ressources" class="form-label">Ressources</label>

			<div class="container mt-5">
			<div id="drop-area" class="drop-area border border-secondary rounded p-4 text-center">
                <p>Glissez vos fichiers ici ou <button type="button" id="file-input-button" class="btn btn-link">Déposer une Ressource</button></p>
                <input type="file" id="file-input" multiple style="display: none;">
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
			</div>
		</div>
		<script src="../assets/script/scriptDepot.js"></script>
<?php
	}
}
?>