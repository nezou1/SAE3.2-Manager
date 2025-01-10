<?php
class ModeleConnexion extends Connexion {
    public function login() {
        try {
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $login = trim($_POST['login']);
                $password = trim($_POST['password']);

                if (empty($login) || empty($password)) {
                    $this->showLoginError("Veuillez remplir tous les champs.");
                    return;
                }

                $user = $this->getUserByLogin($login);

                if ($user) {
                    if (!password_verify($password, $user['password'])) {
                        echo "Le mot de passe est correct.";
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        $_SESSION['prenom'] = $user['prenom'];
                        $_SESSION['nom'] = $user['nom'];
                        $_SESSION['profil'] = $user['profil'];
                        $_SESSION['login'] = $user['login'];

                        header('Location: ./index.php?menu='. $_SESSION['profil'].'&module=dashboard&action=exec');
                        exit();
                    } else {
                        $this->showLoginError("Mot de passe incorrect.");
                    }
                } else {
                    $this->showLoginError("Identifiant incorrect.");
                }
            } else {
                $this->showLoginError("Veuillez remplir tous les champs.");
            }
        } catch (Exception $e) {
            error_log("Erreur lors de la connexion : " . $e->getMessage());
            $this->showLoginError("Une erreur est survenue. Veuillez réessayer plus tard.");
        }
    }

    private function showLoginError($message) {
        echo "<div class='alert alert-danger'>" . htmlspecialchars($message) . "</div>";
        echo "<a href='./index.php?module=connexion&action=login'>Retourner à la connexion</a>";
        header("Refresh: 5; URL=./index.php?module=connexion&action=login");
    }

    public function getUserByLogin($login) {
        $bdd = Connexion::getConnexion();
        $req = "SELECT * FROM Utilisateur WHERE login = :login";
        $pdo_req = $bdd->prepare($req);
        $pdo_req->execute(['login' => $login]);
        return $pdo_req->fetch(PDO::FETCH_ASSOC);
    }
}
?>
