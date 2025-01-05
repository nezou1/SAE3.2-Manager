<?php

class ModeleConnexion {
    private $pdo;

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            try {
                $user = $this->modele->getUserByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['nom'];
                    header('Location: ./index.php?action=dashboard');
                    exit;
                } else {
                    $this->vue->showLoginForm("Identifiant ou mot de passe incorrect.");
                }
            } catch (Exception $e) {
                error_log("Erreur lors de la connexion : " . $e->getMessage());
                $this->vue->showLoginForm("Une erreur est survenue. Veuillez réessayer plus tard.");
            }
        } else {
            $this->vue->formConnexion(); // Affiche le formulaire de connexion
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ./index.php?action=login');
        exit;
    }   

    

    public function getUserByEmail($email) {
        $query = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
