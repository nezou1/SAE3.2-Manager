<?php
class VueMotDePasseOublie extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function get_mdpOublie(){
        
        ?> 
        <div class="container">
            <div class="card shadow p-4">
                <div class="text-center">
                    <img src="../assets/logo.png" alt="SAE Manager Logo" class="logo">
                    <h2 class="mb-4">Mot de passe oublié</h2>
                </div>
                <?php $this->formMotDePasseOublie(); ?>
            </div>
        </div>
        <?php
    }



    public function formMotDePasseOublie() {
        ?>
        <form action="./index.php?module=mdpOublie&action=messageEnvoye" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Votre adresse email" required>
                <?php if (isset($errors['email'])): ?>
                    <small class="error-message"><?= htmlspecialchars($errors['email']) ?></small>
                <?php endif; ?>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="./index.php?module=connexion&action=login" class="btn btn-light">Annuler</a>
                <button type="submit" class="btn btn-secondary">Réinitialiser le mot de passe</button>
            </div>
        </form>
        <?php
    }
}