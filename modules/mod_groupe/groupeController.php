<?php

require_once 'modele_groupe.php';
require_once 'vue_groupe.php';

class ControleurGroupe {
    private $modele;
    private $vue;
    private $action;

    public function __construct() {
        $this->modele = new ModeleGroupe();
        $this->vue = new VueGroupe();
        $this->action = $_GET['action'] ?? 'view';
    }

    public function exec() {
        switch ($this->action) {
            case 'view':
                $this->afficherGroupes();
                break;
            case 'add':
                $this->ajouterGroupe();
                break;
            default:
                $this->vue->afficherErreur("Action inconnue : " . $this->action);
                break;
        }
    }

    private function afficherGroupes() {
        $groupes = $this->modele->getGroupes();
        $this->vue->afficherGroupes($groupes);
    }

    private function ajouterGroupe() {
        $nom = $_POST['nom'] ?? null;
        $modifiableParEtudiant = isset($_POST['modifiable_par_etudiant']) ? 1 : 0;

        if (!$nom) {
            $this->vue->afficherErreur("Le nom du groupe est requis.");
            return;
        }

        $this->modele->addGroupe($nom, $modifiableParEtudiant);
        $this->vue->afficherMessage("Groupe ajouté avec succès.");
        $this->afficherGroupes();
    }
}
