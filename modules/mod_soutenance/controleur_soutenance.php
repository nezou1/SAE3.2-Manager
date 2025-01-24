<?php

require_once  "../modules/mod_soutenance/modele_soutenance.php";
require_once  "../modules/mod_soutenance/vue_soutenance.php";

class ControleurSoutenance {

	private $action;
    private $modele;
    private $vue;

    public function __construct() {
        /*if (!isset($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
        }*/

        $this->modele = new ModeleSoutenance();
        $this->vue = new VueSoutenance();
    }

    public function exec() {
        $this->action = isset($_GET["action"]) ? $_GET["action"] : "liste";

        switch ($this->action) {
            case "liste":
                $this->get_soutenances();
                break;
            case "form_ajout":
                $this->form_ajout();
                break;
            case "ajout":
                $this->ajout();
                break;
            case "mesSoutenances":
                $email = isset($_SESSION['login']) ? $_SESSION['login'] : null;
                $this->mesSoutenanceEtudiant($email);
                break;
            
            default:
                die("Action inexistante");
        }
    }

    private function get_soutenances() {
        $soutenances = $this->modele->get_soutenances();
        $this->vue->get_soutenances($soutenances);
    }

    private function form_ajout() {
        $erreurs = [];
        $this->vue->form_ajout();
    }

    private function ajout() {
      /*  if (!isset($_POST['tokenCSRF']) || $_POST['tokenCSRF'] !== $_SESSION['token']) {
            die("Token incorrect.");
        }*/

        $description = $_POST["description"] ?? null;
        $date = $_POST["dateSout"] ?? null;
        $heureDebut = $_POST["heureDebut"] ?? null;
        $heureFin = $_POST["heureFin"] ?? null;
        $lieu = $_POST["lieu"] ?? null;
        $idGroupe = $_POST["idGroupe"] ?? null;
        $idProjet = $_POST["idProjet"] ?? null;

        if (!$description || !$date || !$heureDebut || !$heureFin || !$lieu || !$idGroupe || !$idProjet) {
            $erreurs = ["parametres" => "Tous les champs sont obligatoires."];
            $this->vue->form_ajout($erreurs, $_SESSION['token']);
            return;
        }

        $this->modele->ajout($description, $date, $heureDebut, $heureFin, $lieu, $idGroupe, $idProjet);

        header("Location: index.php?menu=enseignant&module=soutenance&action=liste");
        exit;
    }

	public function recupererIdEtudiant($email) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT idEtud FROM Etudiant WHERE email = :email";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

	private function mesSoutenanceEtudiant() {
        $idEtudiant = $this->recupererIdEtudiant($_SESSION['login']); // Assurez-vous que l'ID de l'étudiant est stocké dans la session
        $soutenances = $this->modele->mesSoutenancesEtudiant($idEtudiant);
        $this->vue->mesSoutenanceEtudiant($soutenances);
    }
}
?>