<?php

require_once  "../modules/mod_sae/requete_sae.php";

class ModeleSae extends Connexion {

    private $requetes;

    public function __construct() {
        $this->requetes = RequetesSQL::$queries;
    }

    // MES SAES

    public function get_saes($id) {
        $req = ($_GET['menu'] == 'enseignant') ?  $this->requetes['get_saes_ens'] : $this->requetes['get_saes_etud'];
        $pdo_req = self::$bdd->prepare($req);
        $id = (int)$id;
        $pdo_req->execute([$id]);
        $result = $pdo_req->fetchAll();

        return is_array($result) ? $result : null;
    }

    // CREER UNE SAE

    public function liste_enseignants() {
        $req = $this->requetes['liste_enseignant'];
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->bindParam("email_resp", $_SESSION['login']);
        $pdo_req->execute();
        return $pdo_req->fetchAll();
    }

    public function get_id_enseignant($email) {
        $req = $this->requetes['id_enseignant'];
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute(["email" => $email]);
        $result = $pdo_req->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['idEns'] : null;
    }

    public function get_id_etudiant($email) {
        $req = $this->requetes['id_etudiant'];
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute(["email" => $email]);
        $result = $pdo_req->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['idEtud'] : null;
    }

    private function titre_existe($titre) {
        $req = $this->requetes['get_titre_sae'];
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute([$titre]);
        return $pdo_req->fetch();
    }


    private function addProjet($titre, $description, $annee, $semestre) {
        $req = $this->requetes['inserer_projet'];
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute([$titre, $description, $annee, $semestre]);
        return  self::$bdd->lastInsertId();
    }


    private function assigner_ens_comme($email, $id_projet, $role) {
        $req = $this->requetes['inserer_enseignant'];
        $pdo_req = self::$bdd->prepare($req);

        $id_ens = $this->get_id_enseignant($email, $id_projet);
        if ($id_ens !== null)
            $pdo_req->execute([$id_ens, $id_projet, $role]);
        else
            echo "Erreur : L'ID de l'enseignant pour l'email $email est introuvable.";
    }

    private function addIntervenants($intervenants, $id_projet) {
        for ($i = 0; $i < count($intervenants); $i++) {
            $email_intervenant = $intervenants[$i];
            assigner_ens_comme($email_intervenant, $id_projet, 'intervenant');
        }
    }
    
    private function addRessources($mise_en_avant, $idProjet) {
        if (isset($_FILES['ressources'])) {
            $files = $_FILES['ressources'];

            foreach ($files['name'] as $key => $file) {
                $file_basename = pathinfo($file, PATHINFO_FILENAME);
                $file_extension = pathinfo($file, PATHINFO_EXTENSION);
                $name_ressource = $file_basename . '_' . date("Ymd_His") . '.' . $file_extension;

                $uploadDir = './uploads/';
                if(!file_exists($uploadDir)){
                    if (!mkdir($uploadDir, 0777, false)) {
                        echo "Impossible de créer le fichier";
            
                    }
                }
                $destination = $uploadDir . $name_ressource;

                if (move_uploaded_file($files['tmp_name'][$key], $destination)) {
                    $url_ressource = 'http://' . $_SERVER['HTTP_HOST'] . '../' . $destination;

                    $mise_en_avant_values = explode(',', $mise_en_avant);
                    $est_mise_en_avant = isset($mise_en_avant_values[$key]) ? (int)$mise_en_avant_values[$key] : 0;

                    $req = $this->requetes['inserer_ressource'];
                    $pdo_req = self::$bdd->prepare($req);
                    $pdo_req->execute([$name_ressource, $file_extension, $url_ressource, $est_mise_en_avant, $idProjet]);

                } else {
                    echo "Erreur lors du déplacement du fichier $fileName.<br>";
                }
            }            
        }
    }

    public function creer_sae() {
        $errors = [];

        $titre = $_POST["titre"];
		$description = $_POST["description"];
		$annee = $_POST["annee"];
        $semestre = (array_key_exists('semestre', $errors)) ? $_POST['semestre'] : null;
        
        

        if(!$titre)
            $errors['titre'] = "Veuillez nommer le nom de la SAE";
        else if ($this->titre_existe($titre))
            $errors['titre'] = "Ce titre est déjà attribuer à une autre SAE.";

        if(!$description)
            $errors['description'] = "Veuillez décrire la SAE";
        
        if(!$annee)
            $errors['annee'] = "Veuillez donner une année pour la SAE";

        if(!$semestre)
            $errors['semestre'] = "Veuillez donner un semestre pour la SAE";
        else if (is_array($semestre)) {
            $semestre = $semestre[0];
            $semestre = (int)$semestre;
        }
        if (!empty($errors))
            return $errors;

        $annee = (int)$annee;

        $id_projet = $this->addProjet($titre, $description, $annee, $semestre);
        $this->assigner_ens_comme($_SESSION["login"],$id_projet, 'responsable');
    }
}
?>