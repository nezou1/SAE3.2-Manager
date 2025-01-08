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
					<a href="index.php?module=sae&action=form_creer_sae">
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
					<a href="index.php?module=sae&action=acceder_sae&projet=<?=htmlspecialchars($sae)?>">
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
		
	}

	public function form_creer_sae() {
?>
        <h1>Créer une SAE</h1>
        <div class="container">
            <div class="row">
                <!-- Formulaire d'ajout de SAE -->
                <section class="col-md-6">
                    <div class="form-container">
						<form action="index.php?module=sae&action=creer_sae" method="POST" enctype="multipart/form-data" novalidate>
							<!-- Titre -->
							<div class="mb-3">
								<label for="titre" class="form-label">Titre</label>
								<input type="text" id="titre" name="titre" class="form-control" placeholder="Titre" required>
								<?php if (isset($errors['titre'])): ?>
									<small class="error-message"><?= $errors['titre'] ?></small>
								<?php endif; ?>
							</div>
							<!-- Description -->
							<div class="mb-3">
								<label for="description" class="form-label">Description</label>
								<input type="text" id="description" name="description" class="form-control" placeholder="Description" required>
								<?php if (isset($errors['description'])): ?>
									<small class="error-message"><?= $errors['description'] ?></small>
								<?php endif; ?>
							</div>
							<!-- Annee -->
							<div class="mb-3">
								<label for="annee" class="form-label">Annee</label>
								<input type="number" id="annee" name="annee" class="form-control" placeholder="Annee" required>
								<?php if (isset($errors['annee'])): ?>
									<small class="error-message"><?= $errors['annee'] ?></small>
								<?php endif; ?>
							</div>
							<!-- Semestre -->
							<div class="mb-3">
								<label for="semestre" class="form-label">Semestre</label>
								<input type="number" id="semestre" name="semestre" class="form-control" placeholder="Semestre" required>
								<?php if (isset($errors['semestre'])): ?>
									<small class="error-message"><?= $errors['annee'] ?></small>
								<?php endif; ?>
							</div>
							<!-- Intervenants -->
							<div class="mb-3">
								<label for="intervenants" class="form-label">Intervenants</label>
								<?php if (!empty($intervenants)) : ?>
									<select name="intervenants[]" id="intervenants" class="form-select selectpicker" multiple data-live-search="true" data-selected-text-format="count">
										<?php foreach ($intervenants as $intervenant): ?>
											<option value="<?= htmlspecialchars($intervenant['idEns']) ?>">
												<?= htmlspecialchars($intervenant['email']) ?>
											</option>
										<?php endforeach; ?>
									</select>
									<?php if (isset($errors['intervenants'])): ?>
										<div class="text-danger mt-1"><small><?= $errors['intervenants'] ?></small></div>
									<?php endif; ?>
								<?php else : ?>
									<p>Aucun enseignant</p>
							<?php endif?>
							</div>
							<!-- Ressources -->	
							<div class="mb-3">
								<label for="ressources" class="form-label">Ressources</label>
								<div id="ressource-container">
									<!-- Champ de saisie initial -->
									<div class="ressource-item mb-2">
										<input type="file" name="ressources[]" class="form-control" accept=".pdf,.docx,.png,.jpeg">
									</div>
								</div>
								<!-- Boutons pour ajouter ou supprimer des champs -->
								<button type="button" id="add-ressource" class="btn btn-primary btn-sm mt-2">Ajouter une ressource</button>
								<button type="button" id="remove-ressource" class="btn btn-danger btn-sm mt-2">Supprimer une ressource</button>
							</div>

							<!-- Boutons -->
							<div class="d-flex justify-content-between">
								<input type="submit" class="btn btn-primary" value="Créer">
							</div>

                    	</form>
                </section>
            </div>
        </div>
		<script>
			document.getElementById('add-ressource').addEventListener('click', function() {
				const container = document.getElementById('ressource-container');
				const inputFile = document.createElement('div');
				inputFile.classList.add('mb-3');
				inputFile.innerHTML = `
					<div class="d-flex align-items-center">
						<input type="file" name="ressources[]" class="form-control me-2" accept=".pdf,.docx,.png,.jpeg">
						<input type="checkbox" name="highlight[]" class="form-check-input me-2">
						<label class="form-check-label">Mettre en avant</label>
					</div>`;
				container.appendChild(inputFile);
			});

			document.addEventListener("DOMContentLoaded", function () {
				const select = document.querySelector('.selectpicker');
				if (select) {
					$('.selectpicker').selectpicker();
				}
			});

			document.addEventListener("DOMContentLoaded", function () {
			const container = document.getElementById("ressource-container");
			const addButton = document.getElementById("add-ressource");
			const removeButton = document.getElementById("remove-ressource");

			// Ajouter un nouveau champ de ressource
			addButton.addEventListener("click", function () {
				const newField = document.createElement("div");
				newField.classList.add("ressource-item", "mb-2");
				newField.innerHTML = `
					<input type="file" name="ressources[]" class="form-control" accept=".pdf,.docx,.png,.jpeg">
				`;
				container.appendChild(newField);
			});

			// Supprimer le dernier champ de ressource
			removeButton.addEventListener("click", function () {
				const items = container.getElementsByClassName("ressource-item");
				if (items.length > 1) {
					container.removeChild(items[items.length - 1]);
				} else {
					alert("Vous devez conserver au moins un champ de ressource.");
				}
			});
		});
		</script>
<?php
	}
}
?>