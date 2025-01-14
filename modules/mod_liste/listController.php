<?php

require_once 'modele_liste.php';
require_once 'vue_liste.php';

class Controleurliste {
    private $modele;
    private $vue;
    private $action;

    public function __construct() {
        $this->modele = new Modeleliste();
        $this->vue = new Vueliste();
        $this->action = $_GET['action'] ?? 'listeEtudiants';
    }

    public function exec() {
        switch ($this->action) {
            case 'listeEtudiants':
                $result = $this->modele->listeEtudiant();
                $this->vue->afficherListeEtudiants($result);
                break;
            case 'listeEnseignants':
                $result = $this->modele->listeEnseignant();
                $this->vue->afficherListeEtudiants($result);                
                break;
            default:
            $this->vue->get_list();
                break;
        }
    }


}
?>