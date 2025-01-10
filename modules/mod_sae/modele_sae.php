<?php

class ModeleSae extends Connexion {

    // MES SAES

    public function get_saes() {
        $req = "SELECT * FROM Projet";
        $pdo_req = self::$bdd->query($req);
    }

    // CREER UNE SAE
    
    public function creer_sae($titre, $description, $annee, $semestre, $date_depot, $heure_depot, $intervenants, $highlights) {
        $errors = [];

        if ($this->titre_existe($titre))
            $errors['nom_groupe'] = "Ce titre est déjà attribuer à une autre SAE.";
        else 
            $titre = $this->get_titre($titre)['titre'];

        if (!$this->date_valide($annee))
            $errors['annee'] = "L'année est déjà passée.";
        else
            $annee = $this->get_annee($annee)['annee'];

        if($semestre < 1 || $semestre > 6)
            $errors['annee'] = "Saississez un semestre compris entre 1 et 6.";
        else
            $semestre = $this->get_semestre($semestre)['$semestre'];

        foreach ($intervenants as $email_intervenant) {
            if (!$this->intervenant_existe($email_intervenant)) {
                $errors['intervenants'] = "Un des intervenants sélectionnés n'existe pas.";
                break;
            }
        }

        if (!empty($errors))
            return $errors;

        $id_projet = $this->addProjet($titre, $description, $annee, $semestre);

        $this->addIntervenants($intervenants, $id_projet);
        $this->addRessources($highlights, $id_projet);    
    }

    private function get_id_intervenant($email) {
        $req = "SELECT idEns FROM Enseignant WHERE email = ?";
        $pdo_req = self::$bdd->query($req);
        $pdo_req->execute([$email]);
        return $pdo_req->fetch();
    }

    private function addProjet($titre, $description, $annee, $semestre) {
        $req = "INSERT INTO Projet VALUES (?, ?, ?, ?)";
        $pdo_req = self::$bdd->query($req);
        $pdo_req->execute([$titre, $description, $annee, $semestre]);
        return self::$bdd->lastInsertId();
    }

    private function addIntervenants($intervenants, $idProjet) {
        $req = "INSERT INTO estAssigneComme VALUES (?, ?, \"intervenant\")";
        $pdo_req = self::$bdd->query($req);
        foreach ($intervenants as $email_intervenant){
            $id_intervenant = $this->get_id_intervenant($email_intervenant);
            $pdo_req->execute([$idProjet, $id_intervenant]);
        }
    }

    
    private function addRessource($highlight, $idProjet) {
        foreach ($_FILES['ressources']['name'] as $key => $file) {
            $file_basename = pathinfo($file, PATHINFO_FILENAME);
            $file_extension = pathinfo($file, PATHINFO_EXTENSION);
            $name_ressource = $file_basename . '_' . date("Ymd_His") . '.' . $file_extension;
            $is_highlighted = in_array($key, $highlight) ? true : false;
    
            // Insertion dans la base de données
            $req = "INSERT INTO Ressource VALUES (?, ?, ?, ?, ?)";
            $pdo_req = self::$bdd->prepare($req);
            $pdo_req->execute([$name_ressource, $file_extension, $url_ressource, $is_highlighted, $idProjet]);
    
            // Sauvegarde du fichier sur le serveur
            // $target_dir = "uploads/ressources/";
            // $target_file = $target_dir . $name_ressource;
            // move_uploaded_file($_FILES['ressources']['tmp_name'][$key], $target_file);
        }
    }


    

    
}
?>