<?php

require_once 'modele_evaluation.php';
require_once 'vue_evaluation.php';

class EvaluationController
{
    private $action;
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleEvaluation();
        $this->vue = new VueEvaluation();
    }

    public function exec() {
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'evaluerSoutenance';

        switch ($this->action) {
            case 'evaluerSoutenance':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->soumettreEvaluation();
                } else {
                    $this->evaluerSoutenance();
                }
                break;  
            case 'evaluerRendu':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $this->soumettreEvaluation();
                } else {
                    $this->evaluerRendu();
                }
                break;
            case 'confirmeEvaluation':
                $this->vue->confirmeEvaluation();
                break;
            case 'afficherNotesEtudiantSoutenance':
                $this->afficherNotesEtudiantSoutenance();
                break;
        }
    }

    public function evaluerSoutenance() {
        $idSoutenance = $_GET['id'];
        $soutenance = $this->modele->getSoutenanceById($idSoutenance);
        $vue = new VueEvaluation();
        $vue->afficherEvaluationSoutenance($soutenance);
    }

    public function evaluerRendu() {
        $idRendu = $_GET['id'];
        $rendu = $this->modele->getRenduById($idRendu);
        $vue = new VueEvaluation();
        $vue->afficherEvaluationRendu($rendu);
    }

    public function recupererIdEnseignant($email) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT idEns FROM Enseignant WHERE email = :email";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function recupererIdEtudiant($email) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT idEtud FROM Etudiant WHERE email = :email";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function soumettreEvaluation() {
        $id = $_POST['id'];
        $type = $_POST['type'];
        $note = $_POST['note'];
        $commentaire = $_POST['commentaire'];
        $coef = $_POST['coef'];
        $idEns = $this->recupererIdEnseignant($_SESSION['login']); // Assurez-vous que l'ID de l'enseignant est stocké dans la session
        $this->modele->soumettreEvaluation($id, $type, $note, $commentaire, $coef, $idEns);
        header('Location: index.php?module=evaluation&action=confirmeEvaluation');
    }

    public function afficherNotesEtudiantSoutenance() {
        $idEtudiant = $this->recupererIdEtudiant($_SESSION['login']); // Assurez-vous que l'ID de l'étudiant est stocké dans la session
        $notes = $this->modele->getNotesEtudiantSoutenance($idEtudiant);
        $this->vue->afficherNotesEtudiantSoutenance($notes);
    }

}
?>