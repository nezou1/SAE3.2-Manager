<?php

class VueInscription extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function get_inscription(){
        
        ?> 
        <div class="container">
            <div class="card shadow p-4">
                <div class="text-center">
                    <img src="../assets/logo.png" alt="SAE Manager Logo" class="logo">
                    <h2 class="mb-4">Inscription</h2>
                </div>
                <?php $this->formInscription(); ?>
            </div>
        </div>
        <?php
    }

    public function formInscription() {
        ?>
        <form action="./index.php?action=inscrire" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" required>
                <?php if (isset($errors['nom'])): ?>
                    <small class="error-message"><?= htmlspecialchars($errors['nom']) ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom" required>
                <?php if (isset($errors['prenom'])): ?>
                    <small class="error-message"><?= htmlspecialchars($errors['prenom']) ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Adresse email" required>
                <?php if (isset($errors['email'])): ?>
                    <small class="error-message"><?= htmlspecialchars($errors['email']) ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required>
                <?php if (isset($errors['password'])): ?>
                    <small class="error-message"><?= htmlspecialchars($errors['password']) ?></small>
                <?php endif; ?>
            </div>
            <div class="row gx-2 mb-3">
                <div class="col-12 col-md-6">
                    <label for="profil" class="form-label">Profil</label>
                    <select id="profil" name="profil" class="form-select">
                        <option value="etudiant">Étudiant</option>
                        <option value="enseignant">Enseignant</option>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label for="activation_key" class="form-label">Clé d'activation</label>
                    <input id="activation_key" type="text" name="activation_key" class="form-control" placeholder="Clé d'activation">
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-secondary">S'inscrire</button>
            </div>
            <div class="text-center mt-3">
                <a href="./index.php?module=connexion&action=login" class="text-decoration-none text-primary">Vous avez déjà un compte ? Connectez-vous !</a>
            </div>
        </form>
        <?php
    }

    public function confirmeInscription() {
        ?>
        <div class="container mt-5">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Inscription réussie !</h4>
                <p>Votre compte a été créé avec succès.</p>
                <hr>
                <p class="mb-0">
                    <a href="index.php?action=login" class="btn btn-primary">Se connecter</a>
                </p>
            </div>
        </div>
        <?php
    }
}

?>