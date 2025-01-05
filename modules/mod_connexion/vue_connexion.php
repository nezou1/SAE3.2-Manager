<?php

class VueConnexion extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function get_connexion(){
        
        ?> 
        <div class="container">
            <div class="card shadow p-4">
                <div class="text-center">
                    <img src="../assets/logo.png" alt="SAE Manager Logo" class="logo">
                    <h2 class="mb-4">Connexion</h2>
                    <?php $this->formConnexion(); ?> 
                </div>
                
            </div>
        </div>
        <?php
    }
    
   public function formConnexion() {
        ?>
        <form action="./index.php?action=connexion" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Identifiant</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Identifiant" required>
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
            <div class="d-grid">
                <button type="submit" class="btn btn-dark ">
                    <a href="./index.php?module=dashboard&action=exec" class="text-decoration-none text-black">Connexion</a><br>
                </button>
            </div>
            <div class="text-center mt-3">
                <a href="./index.php?module=inscription&action=form" class=" text-black">Vous n’avez pas de compte ? Inscrivez-vous !</a><br>
                <a href="./index.php?module=mdpOublie&action=mdpOublie" class=" text-black">Mot de passe oublié ?</a>
            </div>
        </form>
        <?php
    }


    public function showSuccessLogout() {
        ?>
        <div class="container mt-5">
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Déconnexion réussie !</h4>
                <p>Vous avez été déconnecté avec succès.</p>
                <hr>
                <p class="mb-0">
                    <a href="./index.php?action=login" class="btn btn-primary">Se reconnecter</a>
                </p>
            </div>
        </div>
        <?php
    }

    public function showLoginError() {
        ?>
        <div class="container mt-5">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Erreur de connexion</h4>
                <p>Identifiant ou mot de passe incorrect. Veuillez réessayer.</p>
                <hr>
                <p class="mb-0">
                    <a href="./index.php?action=login" class="btn btn-primary">Retourner à la page de connexion</a>
                </p>
            </div>
        </div>
        <?php
    }
}
