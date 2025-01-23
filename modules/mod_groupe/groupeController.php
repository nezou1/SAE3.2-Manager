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
            case 'mes_groupes':
                $this->afficherGroupesEtudiant($_SESSION['idEtudiant'] ?? null);
                break;
            case 'voir_membres':
                $this->afficherMembresGroupe($_GET['idGroupe'] ?? null);
                break;
            default:
                $this->vue->afficherErreur("Action inconnue : " . htmlspecialchars($this->action));
                break;
        }
    }

    private function afficherGroupes() {
        $groupes = $this->modele->getGroupes();
        $etudiants = $this->modele->getEtudiants();
        $this->vue->afficherGroupes($groupes, $etudiants);
    }

    private function ajouterGroupe() {
        if (!isset($_POST['nom']) || trim($_POST['nom']) === '') {
            $groupes = $this->modele->getGroupes();
            $etudiants = $this->modele->getEtudiants();
            $this->vue->afficherGroupes($groupes, $etudiants);
            $this->vue->afficherErreur("Le nom du groupe est requis.");
            return;
        }
    
        $nom = htmlspecialchars(trim($_POST['nom']));
        $modifiableParEtudiant = isset($_POST['modifiable_par_etudiant']) ? 1 : 0;
        $etudiants = $_POST['etudiants'] ?? [];
    
        $idGroupe = $this->modele->addGroupe($nom, $modifiableParEtudiant);
        $this->modele->lierEtudiantsAuGroupe($idGroupe, $etudiants);
    
        $this->vue->afficherMessage("Groupe ajouté avec succès.");
        $this->afficherGroupes();
    }
    
       
    private function afficherGroupesEtudiant($idEtudiant = null) {
        if (!$idEtudiant) {
            if (isset($_SESSION['idEtud'])) {
                $idEtudiant = $_SESSION['idEtud'];
            } else {
                $this->vue->afficherErreur("Vous devez être connecté pour voir vos groupes.");
                return;
            }
        }
    
        $groupes = $this->modele->getGroupesParEtudiant($idEtudiant);
        $this->vue->afficherGroupesEtudiant($groupes);
    }

    private function afficherMembresGroupe($idGroupe) {
        if (!$idGroupe) {
            $this->vue->afficherErreur("Identifiant du groupe manquant.");
            return;
        }

        $membres = $this->modele->getMembresGroupe($idGroupe);
        $this->vue->afficherMembresGroupe($membres);
    }
}
?>
