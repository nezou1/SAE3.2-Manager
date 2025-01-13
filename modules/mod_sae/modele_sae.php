<?php

require_once PROJECT_ROOT . "/modules/mod_sae/requete_sae.php";

class ModeleSae extends Connexion {

    private $requetes;

    public function __construct() {
        $this->requetes = RequetesSQL::$queries;
    }

    // MES SAES

    public function get_saes() {
        $req = "SELECT * FROM Projet";
        $pdo_req = self::$bdd->query($req);
    }

    // CREER UNE SAE

    public function liste_enseignants($email_responsable) {
        $req = $this->requetes['liste_enseignant'];
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->bindParam("email_resp", $email_responsable);
        $pdo_req->execute();
        return $pdo_req->fetchAll();
    }

    private function get_id_intervenant($email) {
        $req = $this->requetes['id_intervenant'];
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute([$email]);
        return $pdo_req->fetch();
    }

    
    public function creer_sae($titre, $description, $annee, $semestre, $date_depot, $intervenants, $ressources, $highlights) {
        $errors = [];

        if ($this->titre_existe($titre))
            $errors['nom_groupe'] = "Ce titre est déjà attribuer à une autre SAE.";

        if (!empty($errors))
            return $errors;

        if (is_array($semestre)) {
            $semestre = $semestre[0];  // Extrait la première valeur du tableau
        }
        $semestre = (int)$semestre;
        $annee = (int)$annee;

        $id_projet = $this->addProjet($titre, $description, $annee, $semestre);

        $this->addIntervenants($intervenants, $id_projet);
        $this->addRessources($highlights, $id_projet);    
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
        return self::$bdd->lastInsertId();
    }

    private function addIntervenants($intervenants, $idProjet) {
        $req = $this->requetes['inserer_intervenant'];
        $pdo_req = self::$bdd->prepare($req);
        foreach ($intervenants as  $email_intervenant){
            $id_intervenant = $this->get_id_intervenant($email_intervenant);
            $pdo_req->execute([$id_intervenant, $idProjet]);
        }
    }

    
    private function addRessources($highlight, $idProjet) {
        if (isset($_FILES['ressources'])) {
            $files = $_FILES['ressources'];

            foreach ($files['name'] as $key => $file) {
                $file_basename = pathinfo($file, PATHINFO_FILENAME);
                $file_extension = pathinfo($file, PATHINFO_EXTENSION);
                $name_ressource = $file_basename . '_' . date("Ymd_His") . '.' . $file_extension;

                $uploadDir = 'uploads/';
                $destination = $uploadDir . basename($fileName);
                if (move_uploaded_file($files['tmp_name'][$key], $destination)) {
                    $url_ressource = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $destination;

                    // Vérifiez si le fichier doit être mis en avant
                    $is_highlighted = in_array($key, $highlight) ? true : false;

                    // Insertion dans la base de données
                    $req = $this->requetes['inserer_ressource'];
                    $pdo_req = self::$bdd->prepare($req);
                    $pdo_req->execute([$name_ressource, $file_extension, $url_ressource, $is_highlighted, $idProjet]);

                    // echo "Le fichier $fileName a été téléchargé avec succès. Mis en avant : $isHighlighted<br>";
                } else {
                    echo "Erreur lors du déplacement du fichier $fileName.<br>";
                }
            }            
        }
    }


    

    
}
?>