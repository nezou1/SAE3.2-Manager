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
            default:
                $this->vue->afficherErreur("Action inconnue : " . $this->action);
                break;
        }
    }

    private function afficherDepots() {
        $idProjet = $_GET['idProjet'] ?? null;
        $idGroupe = $_SESSION['idGroupe'] ?? null;

        if (!$idProjet || !$idGroupe) {
            $this->vue->afficherErreur("Données manquantes pour afficher les dépôts.");
            return;
        }

        $depots = $this->modele->getDepotsByProjet($idProjet, $idGroupe);
        $projetDetails = $this->modele->getProjetDetails($idProjet);

        $this->vue->afficherDepots($depots, $projetDetails);
    }

    private function ajouterDepot() {
        $idProjet = $_POST['idProjet'] ?? null;
        $idGroupe = $_SESSION['idGroupe'] ?? null;
        $descriptif = $_POST['descriptif'] ?? null;

        if (!$idProjet || !$idGroupe || !$descriptif) {
            $this->vue->afficherErreur("Tous les champs sont requis pour ajouter un dépôt.");
            return;
        }

        $this->modele->addDepot($idProjet, $idGroupe, $descriptif, date('Y-m-d'));
        $this->vue->afficherMessage("Dépôt ajouté avec succès.");
        $this->afficherDepots();
    }
}
