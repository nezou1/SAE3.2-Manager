<?php


require_once(PROJECT_ROOT .'/core/connexion.php');
class ModeleDashboard extends Connexion {

    public function getUserInfo($email) {
        $bdd = Connexion::getConnexion();

        // Requête pour vérifier dans la table étudiant
        $sqlEtudiant = "SELECT * FROM Etudiant WHERE email = :email";
        $stmt = $bdd->prepare($sqlEtudiant);
        $stmt->execute(['email' => $email]);
        $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($etudiant) {
            return ['role' => 'etudiant', 'user' => $etudiant];
        }

        // Requête pour vérifier dans la table enseignant
        $sqlEnseignant = "SELECT * FROM Enseignant WHERE email = :email";
        $stmt = $bdd->prepare($sqlEnseignant);
        $stmt->execute(['email' => $email]);
        $enseignant = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($enseignant) {
            return ['role' => 'enseignant', 'user' => $enseignant];
        }

        return null;
    }

    public function afficherDashboard() {
        $email = $_SESSION['login'] ?? null;

        if (!$email) {
            echo "Erreur : Aucun utilisateur connecté.";
            return;
        }

        $userInfo = $this->getUserInfo($email);

        if (!$userInfo) {
            echo "Erreur : utilisateur non trouvé.";
            return;
        }

        $role = $userInfo['role'];
        $user = $userInfo['user'];
        $_SESSION['prenom'] = $user['prenom'] ?? 'Utilisateur';
        $_SESSION['nom'] = $user['nom'] ?? '';
        $_SESSION['role'] = $role;

        $vue = new VueDashboard();
        if ($role === 'etudiant') {
            $vue->afficherEtudiant();
        } else {
            $vue->afficherEnseignant();
        }
    }

}
