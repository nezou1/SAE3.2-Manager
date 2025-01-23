<?php

require_once 'modele_Depot.php';
require_once 'vue_Depot.php';

class ControleurDepot {
    private $modele;
    private $vue;
    private $action;

    public function __construct() {
        $this->modele = new ModeleDepot();
        $this->vue = new VueDepot();
        $this->action = $_GET['action'] ?? 'add';
        
    }

    public function exec() {
        switch ($this->action) {
            case 'view':
                $this->afficherDepots();
                break;
            case 'add':
                $this->ajouterDepot();
                break;
            case 'download':
                $this->telechargerFichier();
                break;
            default:
                $this->vue->afficherErreur("Action inconnue : " . htmlspecialchars($this->action ?? ''));
                break;
        }
    }

    private function afficherDepots() {
        $idProjet = $_GET['projet'] ?? null;
        $idGroupe = $_GET['groupe'] ?? null;

        if (!$idProjet || !$idGroupe) {
            $this->vue->afficherErreur("Données manquantes pour afficher les dépôts.");
            return;
        }

        $depots = $this->modele->getDepotsByProjet($idProjet, $idGroupe);
        $projetDetails = $this->modele->getProjetDetails($idProjet);

        $this->vue->afficherDepots($depots, $projetDetails);
    }

    private function ajouterDepot() {
       
        
        $idProjet = $_GET['idProjet'] ?? null;
        $idGroupe = $_GET['idGroupe'] ?? null;
        $descriptif = $_POST['descriptif'] ?? null;

       
    
        if (!$idProjet || !$idGroupe || !$descriptif || !isset($_FILES['fichier'])) {
            $this->vue->afficherErreur("Tous les champs sont requis pour ajouter un dépôt.");
            return;
        }
    
        $fichier = file_get_contents($_FILES['fichier']['tmp_name']);
        $nomFichier = $_FILES['fichier']['name'];
        
        $idGroupe = "SELECT idGroupe FROM estDansCeProjet";
      
        $projets = $this->modele->getAllProjets();
        foreach ($projets as $projet) {
            $this->modele->addDepot($projet['idProjet'], $idGroupe, $descriptif, date('Y-m-d'), $fichier, $nomFichier);
        }
        $this->modele->addDepot($idProjet, $idGroupe, $descriptif, date('Y-m-d'), $fichier, $nomFichier);
        $this->vue->afficherMessage("Dépôt ajouté avec succès.");
        $this->afficherDepots();
    }
    

    private function telechargerFichier() {
        $idRendu = $_GET['idRendu'] ?? null;
        if (!$idRendu) {
            $this->vue->afficherErreur("ID de rendu manquant.");
            return;
        }

        $fichier = $this->modele->getFichierById($idRendu);
        if ($fichier) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . htmlspecialchars($fichier['nomFichier'] ?? 'fichier') . '"');
            echo $fichier['fichier'];
            exit;
        } else {
            $this->vue->afficherErreur("Fichier introuvable.");
        }
    }
}
?>
