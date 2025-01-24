<?php

require_once 'modele_evaluation.php';
require_once 'vue_evaluation.php';

class EvaluationController
{
    private $action;
    private $modele;
    private $vue;

    public function __construct() {
        // Démarrer la session si elle n'est pas déjà active
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->modele = new ModeleEvaluation();
        $this->vue = new VueEvaluation();
    }

    public function exec() {
        // Activer l'affichage des erreurs pour le débogage
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Vérification de l'action demandée dans l'URL
        $this->action = $_GET['action'] ?? 'evaluerSoutenance';

        switch ($this->action) {
            case 'evaluerSoutenance':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->soumettreEvaluation();
                } else {
                    $this->evaluerSoutenance();
                }
                break;

            case 'evaluerRendu':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->soumettreEvaluation();
                } else {
                    $this->evaluerRendu();
                }
                break;

            case 'soumettreEvaluation':
                $this->soumettreEvaluation();
                break;

            case 'confirmeEvaluation':
                $this->vue->confirmeEvaluation();
                break;

            case 'afficherNotesEtudiantSoutenance':
                $this->afficherNotesEtudiantSoutenance();
                break;

            default:
                die("Action non reconnue : " . htmlspecialchars($this->action));
        }
    }

    public function evaluerSoutenance() {
        $idSoutenance = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$idSoutenance) {
            die("ID de soutenance invalide.");
        }

        $soutenance = $this->modele->getSoutenanceById($idSoutenance);

        if (!$soutenance) {
            die("Aucune soutenance trouvée pour l'ID : " . htmlspecialchars($idSoutenance));
        }

        $this->vue->afficherEvaluationSoutenance($soutenance);
    }

    public function evaluerRendu() {
        $idRendu = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$idRendu) {
            die("ID du rendu invalide.");
        }

        $rendu = $this->modele->getRenduById($idRendu);

        if (!$rendu) {
            die("Aucun rendu trouvé pour l'ID : " . htmlspecialchars($idRendu));
        }

        $this->vue->afficherEvaluationRendu($rendu);
    }

    public function soumettreEvaluation() {
        if (!isset($_SESSION['login'])) {
            die("Veuillez vous connecter.");
        }

        // Vérification des données du formulaire
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $note = filter_input(INPUT_POST, 'note', FILTER_VALIDATE_FLOAT);
        $commentaire = htmlspecialchars($_POST['commentaire'], ENT_QUOTES, 'UTF-8');
        $coef = filter_input(INPUT_POST, 'coef', FILTER_VALIDATE_FLOAT);
        $type = $_POST['type'] ?? '';

        if (!$id || !$note || !$commentaire || !$coef || empty($type)) {
            die("Tous les champs du formulaire sont requis.");
        }

        $idEns = $this->modele->recupererIdEnseignant($_SESSION['login']);
        if (!$idEns) {
            die("Erreur lors de la récupération de l'enseignant.");
        }

        $this->modele->soumettreEvaluation($id, $type, $note, $commentaire, $coef, $idEns);
        header('Location: index.php?module=evaluation&action=confirmeEvaluation');
        exit;
    }

    public function afficherNotesEtudiantSoutenance() {
        if (!isset($_SESSION['login'])) {
            die("Veuillez vous connecter.");
        }

        $idEtudiant = $this->modele->recupererIdEtudiant($_SESSION['login']);
        if (!$idEtudiant) {
            die("Aucune donnée trouvée pour cet étudiant.");
        }

        $notes = $this->modele->getNotesEtudiantSoutenance($idEtudiant);
        $this->vue->afficherNotesEtudiantSoutenance($notes);
    }
}
?>
