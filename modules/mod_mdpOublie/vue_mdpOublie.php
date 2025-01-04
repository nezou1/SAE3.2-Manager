<?php
class VueMotDePasseOublie extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function formMotDePasseOublie($errors = []) {
        ob_start();
        ?>
        <form action="./index.php?action=forgot_password" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Votre adresse email" required>
                <?php if (isset($errors['email'])): ?>
                    <small class="error-message"><?= htmlspecialchars($errors['email']) ?></small>
                <?php endif; ?>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="./index.php?action=login" class="btn btn-light">Annuler</a>
                <button type="submit" class="btn btn-secondary">Réinitialiser le mot de passe</button>
            </div>
        </form>
        <?php
        $content = ob_get_clean();
        Template::render('Mot de passe oublié - SAE Manager', $content);
    }
}