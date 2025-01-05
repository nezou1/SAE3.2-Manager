<?php

class ModeleConnexion extends Connexion {
    private $pdo;

    public function login() {
        try {
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $login = trim($_POST['login']);
                $password = trim($_POST['password']);

                $user = $this->getUserByLogin($login);

                var_dump($user);

                echo "Mot de passe saisi : " . $password;
echo "Hash stocké : " . $user['password'];
echo "Résultat de password_verify : " . (password_verify($password, $user['password']) ? 'true' : 'false');

$motDePasseSaisi = "root";
$hashEnBase = '$2y$10$czN7bbimGosPEMdBS19LS.VBt/B3DUH3XANJNa0MScAr/XJbaHndi';

if (password_verify($motDePasseSaisi, $hashEnBase)) {
    echo "Mot de passe correct !";
} else {
    echo "Mot de passe incorrect !";
}


                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        session_start();
                        $_SESSION['prenom'] = $user['prenom'];
                        $_SESSION['nom'] = $user['nom'];
                        $_SESSION['profil'] = $user['profil'];
    
                        // Redirection vers le tableau de bord
                        echo "Connexion réussie !";
                        $_SESSION['login'] = $user['login'];
                        header('Location: ./index.php?module=dashboard&action=exec');
                        exit();
                    } else {
                        $this->showLoginError("Mot de passe incorrect. :(");
                    }

                }else{
                    $this->showLoginError("Identifiant incorrect.");
                    exit();
                }

            } else {
                $this->showLoginError("Veuillez remplir tous les champs.");
            }
                
        } catch (Exception $e) {
            error_log("Erreur lors de la connexion : " . $e->getMessage());
            $this->showLoginError("Une erreur est survenue. Veuillez réessayer plus tard.");
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ./index.php?module=connexion&action=login');
        exit();
    }

    private function showLoginError($message) {
        echo "<div class='alert alert-danger'>$message</div>";
        echo "<a href='./index.php?module=connexion&action=login'>Retourner à la connexion</a>";
    }

    public function getUserByLogin($login) {
        $bdd = Connexion::getConnexion();  // Récupérer la connexion depuis la classe Connexion
        $req = "SELECT * FROM Utilisateur WHERE login = :login";
        $pdo_req = $bdd->prepare($req);
        $pdo_req->execute(['login' => $login]);
        $user = $pdo_req->fetch(PDO::FETCH_ASSOC);  // Renvoie un tableau associatif ou false

        if (!$user) {
            echo "Aucun utilisateur trouvé pour le login : $login";
            exit();
        }

        return $user;  // Retourne l'utilisateur récupéré
    }
}
