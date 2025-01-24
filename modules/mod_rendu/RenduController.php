<?php

require_once 'modele_rendu.php';
require_once 'vue_rendu.php';

class RenduController
{
    private $action;
    private $modele;
    private $vue;

    public function __construct() {
        $this->modele = new ModeleRendu();
        $this->vue = new VueRendu();
    }

    public function exec() {
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'accueilEval';

        switch ($this->action) {
            case 'accueilEval':
                $this->afficher();
                break;
            case 'creerDepot':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->creerDepot();
                } else {
                    $this->vue->creerDepot();
                }
                break;
            default:
                $this->afficher(); // Par défaut, afficher la page d'évaluation
        }
    }

    public function afficher() {
        if (!isset($_SESSION['login'])) {
            // Rediriger si l'utilisateur n'est pas connecté
            header('Location: index.php?module=connexion');
            exit();
        }
        // Récupère l'ID de l'enseignant dans la session
        try {
            $soutenances = $this->modele->getSoutenancesByEnseignant($_SESSION['login']);
            $rendus = $this->modele->getRendusByEnseignant($_SESSION['login']);

            if (empty($soutenances) && empty($rendus)) {
                error_log('Aucune donnée trouvée pour l enseignant : ' . $_SESSION['login']);
            }

            $this->vue->afficherPageEnseignant($soutenances, $rendus);
        } catch (Exception $e) {
            error_log('Erreur lors de la récupération des données : ' . $e->getMessage());
            echo '<p>Une erreur est survenue lors du chargement des données.</p>';
        }
    }

    public function creerDepot() {
        $descriptif = $_POST['descriptif'];
        $dateAttendu = $_POST['dateAttendu'];
        $idProjet = $_POST['idProjet'];

        // Save the depot submission form details to the database
        $this->modele->creerDepot($descriptif, $dateAttendu, $idProjet);

        // Redirect to the instructor's page
        header('Location: index.php?module=rendu');
    }
}
?>