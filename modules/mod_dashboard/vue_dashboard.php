<?php

class VueDashboard extends VueGenerique {

    public function __construct() {
        parent::__construct();  // Appelle le constructeur de VueGenerique (si nécessaire)
    }

    // Méthode principale pour afficher le tableau de bord en fonction du rôle
    public function get_dashboard($role, $prenom, $nom) {
        if ($role === 'Enseignant') {
            $this->afficherEnseignant($prenom, $nom);
        } else {
            $this->afficherEtudiant($prenom, $nom);
        }
    }

    // Vue pour le dashboard étudiant
    private function afficherEtudiant($prenom, $nom) {
        ?>
        <h1>Dashboard Étudiant</h1>
        <p>Bienvenue, <?php echo htmlspecialchars($prenom . ' ' . $nom); ?> !</p>
        <div class="nav-bar">
            <a href="index.php">Accueil</a>
            <a href="cours.php">Mes Cours</a>
            <a href="ressources.php">Ressources</a>
            <a href="depot.php">Dépôt de documents</a>
        </div>
        <div class="content">
            <h2>Mes ressources</h2>
            <p>Accédez à vos cours, déposez des documents, et consultez des ressources pédagogiques.</p>
        </div>
        <?php
    }

    // Vue pour le dashboard enseignant
    private function afficherEnseignant($prenom, $nom) {
        ?>
        <h1>Dashboard Enseignant</h1>
        <p>Bienvenue, <?php echo htmlspecialchars($prenom . ' ' . $nom); ?> !</p>
        <div class="nav-bar">
            <a href="index.php">Accueil</a>
            <a href="cours.php">Mes Cours</a>
            <a href="etudiants.php">Gestion des étudiants</a>
            <a href="creation_sae.php">Création de SAE</a>
        </div>
        <div class="content">
            <h2>Gestion des cours</h2>
            <p>Accédez à vos cours, gérez vos SAE, et consultez les travaux déposés par les étudiants.</p>
        </div>
        <?php
    }


}
