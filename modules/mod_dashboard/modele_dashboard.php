<?php

require_once('/Users/nezhaelfayez/Desktop/IUT/S3/PHP/local_html/SAE3.2-Manager/core/connexion.php');


class ModeleDashboard extends Connexion{

    public function get_dashboard() {
        $sql = "SELECT * FROM `users` WHERE `id` = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $_SESSION['id']]);
        $user = $stmt->fetch();
        return $user;
    }

    function afficherDashboard() {
        $prenom = $_SESSION['prenom'] ?? 'Utilisateur';
        $nom = $_SESSION['nom'] ?? '';
        $role = $_SESSION['role'] ?? 'Étudiant';  // Rôle par défaut
        $vue = new VueDashboard();  // Instanciation de la vue
        $vue->get_dashboard($role, $prenom, $nom);  // Affichage du tableau de bord selon le rôle
    }
}