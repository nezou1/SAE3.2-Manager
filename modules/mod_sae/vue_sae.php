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
				<?php if ($_GET["menu"] == "enseignant") { ?>
					<a href="index.php?menu=enseignant&module=sae&action=form_creer_sae">
						<button class="btn btn-primary w-100">Créer une SAE</button>
					</a>
				<?php } ?>
			</div>
		</div>
	<?php
	}

	private function get_saes($saes) {
		if ($saes){
			foreach($saes as $sae){
				$menu = ($_GET['menu'] == 'enseignant') ? 'enseignant' : 'etudiant';
	?>
				<div class="col-md-4">
					<a href="index.php?menu=<?= $menu ?>&module=sae&action=acceder_sae&projet=<?=htmlspecialchars($sae['idProjet'])?>">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title"><?= htmlspecialchars($sae['titre'])?></h5>
								<p class="card-text">
									Année : <?= htmlspecialchars($sae['annee'])?><br>
									S<?= htmlspecialchars($sae['semestre'])?>
								</p>
							</div>
						</div>
					</a>
				</div>
	<?php		
			}
		} else {
	?>
			<div class="col-md-4">									
				<p>Vous n'avez aucune SAE pour le moment</p>
			</div>
	<?php	
		}
	}

	public function acceder_sae($sae, $enseignants, $ressources, $groupes, $etudiants, $soutenances) {
	?>		
		<div class="container">
			<h1 class="text-center mb-4"><?= htmlspecialchars($sae['titre'])?></h1>
			<div class="top-0 start-0 p-3 text-white rounded" style="background-color: #91A89B;">
				<strong>Année : </strong><?= htmlspecialchars($sae['annee'])?><br>
				<strong>S<?= htmlspecialchars($sae['semestre'])?></strong>
			</div>
			<div class="mb-4">
				<h4>Description</h4>
				<textarea class="form-control" rows="5" readonly><?= htmlspecialchars($sae['description'])?></textarea>
			</div>
			<div class="mb-4">
				<h4>Ressources Associées</h4>
				<ul class="list-unstyled">
					<?php foreach ($ressources as $ressource): ?>
						<li><a href="<?= htmlspecialchars($ressource['url']) ?>"><?= htmlspecialchars($ressource['nom']) ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="mb-4">
				<h4>Groupes</h4>
				<ul class="list-unstyled">
					<?php foreach ($groupes as $groupe): ?>
						<li><?= htmlspecialchars($groupe['nom']) ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="mb-4">
				<h4>Soutenances</h4>
				<ul class="list-unstyled">
					<?php foreach ($soutenances as $soutenance): ?>
						<li><?= htmlspecialchars($soutenance['description']) ?> - <?= htmlspecialchars($soutenance['dateSout']) ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	<?php
	}

	public function form_creer_sae($erreurs) {
	?>
        <h1>Créer une SAE</h1>
        <div class="container">
            <div class="row">
                <section class="col-md-6">
                    <div class="form-container">
						<form action="index.php?menu=enseignant&module=sae&action=creer_sae" method="POST" enctype="multipart/form-data">
							<div class="mb-3">
								<label for="titre" class="form-label">Titre</label>
								<input type="text" id="titre" name="titre" class="form-control">
								<?php if (isset($erreurs['titre'])): ?>
									<small class="text-danger"><?= $erreurs['titre'] ?></small>
								<?php endif; ?>
							</div>
							<div class="mb-3">
								<label for="description" class="form-label">Description</label>
								<textarea id="description" name="description" class="form-control"></textarea>
								<?php if (isset($erreurs['description'])): ?>
									<small class="text-danger"><?= $erreurs['description'] ?></small>
								<?php endif; ?>
							</div>
							<div class="mb-3">
								<label for="annee" class="form-label">Année</label>
								<input type="number" id="annee" name="annee" class="form-control" min="<?= date('Y') ?>">
								<?php if (isset($erreurs['annee'])): ?>
									<small class="text-danger"><?= $erreurs['annee'] ?></small>
								<?php endif; ?>
							</div>
							<div class="mb-3">
								<label for="semestre" class="form-label">Semestre</label>
								<select name="semestre[]" id="semestre" class="form-select">
									<option value="1">S1</option>
									<option value="2">S2</option>
								</select>
								<?php if (isset($erreurs['semestre'])): ?>
									<small class="text-danger"><?= $erreurs['semestre'] ?></small>
								<?php endif; ?>
							</div>
							<input type="submit" class="btn btn-primary" value="Créer">
						</form>
					</div>
                </section>
            </div>
        </div>
	<?php
	}

	public function confirmeAjout() {
	?>
		<div class="container text-center">
			<h1 class="text-success">SAE ajoutée avec succès !</h1>
			<p>Vous allez être redirigé...</p>
		</div>
		<script>
			setTimeout(() => {
				window.location.href = "index.php?menu=enseignant&module=sae&action=mes_saes";
			}, 3000);
		</script>
	<?php
	}
}
?>
