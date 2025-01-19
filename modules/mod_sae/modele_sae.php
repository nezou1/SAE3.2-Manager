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

        return !empty($result) ? $result : null;
    }

    // ACCEDER A UNE SAE

    public function get_projet($id_projet) {
        $req =  $this->requetes['get_projet'];
        $pdo_req = self::$bdd->prepare($req);
        $id_projet = (int)$id_projet;
        $pdo_req->execute([$id_projet]);
        return $pdo_req->fetch(PDO::FETCH_ASSOC);
    }

    private function get_elements($requete, $id) {
        $pdo_req = self::$bdd->prepare($requete);
        $id = (int)$id;
        $pdo_req->execute([$id]);
        return $pdo_req->fetchAll();
    }

    public function get_enseignants_sae($id_projet) {
        return $this->get_elements(
            $this->requetes['get_enseignants_sae'],
            $id_projet
        );
    }

    public function get_ressources_sae($id_projet) {
        return $this->get_elements(
            $this->requetes['get_ressources_sae'],
            $id_projet
        );
    }

    public function get_groupes_sae($id_projet) {
        return $this->get_elements(
            $this->requetes['get_groupes_sae'],
            $id_projet
        );
    }

    public function get_etudiants_sans_grp() {
        $requete = $this->requetes['get_etudiants_sans_grp'];
        $pdo_req = self::$bdd->prepare($requete);
        $pdo_req->execute();
        return $pdo_req->fetchAll();
    }

    public function get_etudiants_grp($id_groupe) {
        return $this->get_elements(
            $this->requetes['get_etudiants_grp'],
            $id_groupe
        );
    }

    public function get_rendus_sae($id_projet, $id_grp) {
        $requete = $this->requetes['get_rendus_sae'];
        $pdo_req = self::$bdd->prepare($requete);
        $id_projet = (int)$id_projet;
        $pdo_req->execute([$id_projet, $id_grp]);
        return $pdo_req->fetchAll();
    }

    public function get_soutenances_sae($id_projet) {
        $requete = $this->requetes['get_soutenances_sae'];
        $pdo_req = self::$bdd->prepare($requete);
        $id_projet = (int)$id_projet;
        $pdo_req->execute([$id_projet]);

        $soutenances = $pdo_req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($soutenances as &$soutenance) {
            $soutenance['jurys'] = $this->getJuryByIdSoutenance($soutenance['idSoutenance']);
        }
        return $soutenances;
    }

    private function getJuryByIdSoutenance($id) {
        $requete = $this->requetes['get_jury'];
        $pdo_req = self::$bdd->prepare($requete);
        $pdo_req->execute([$id]);
        return $pdo_req->fetchAll(PDO::FETCH_COLUMN); // Récupère uniquement les noms des jurys
    }

    // AJOUTER UN GROUPE

    private function addGroupe($nom, $modifiableParEtudiant) {
        $requete = $this->requetes['inserer_groupe'];
        $pdo_req = self::$bdd->prepare($requete);
        $pdo_req->execute([
            'nom' => $nom,
            'modifiable_par_etudiant' => $modifiableParEtudiant
        ]);
        return self::$bdd->lastInsertId(); 
    }

    private function lierEtudiantsAuGroupe($idGroupe, $etudiants) {
        $requete = $this->requetes['lier_etud_au_groupe'];
        $pdo_req = self::$bdd->prepare($requete);
        foreach ($etudiants as $idEtudiant) {
            $pdo_req->execute([
                'idGroupe' => $idGroupe,
                'idEtud' => $idEtudiant
            ]);
        }
    }

    public function ajouter_groupe() {
        $errors = [];
        $response = [];
    
        // Récupération des données
        $nomGroupe = isset($_POST['nom_grp']) ? trim($_POST['nom_grp']) : null;
        $modifiableParEtudiant = isset($_POST['modifiable_par_etudiant']) ? (int)$_POST['modifiable_par_etudiant'] : 0;
        $etudiants = isset($_POST['etudiants']) ? $_POST['etudiants'] : [];
    
        // Validation des données
        if (empty($nomGroupe)) {
            $errors['nom_grp'] = "Le nom du groupe est obligatoire.";
        }// else if ($this->nom_groupe_existe($nomGroupe)) {
        //     $errors['nom_grp'] = "Le nom du groupe est déjà utilisé.";
        // }
    
        if (empty($etudiants) || !is_array($etudiants)) {
            $errors['etudiants'] = "Veuillez sélectionner au moins deux étudiants.";
        } else if (count($etudiants) < 2) {
            $errors['etudiants'] = "Au moins deux étudiants doivent être sélectionnés.";
        }
    
        // Gestion des erreurs
        if (!empty($errors)) {
            $response['success'] = false;
            $response['errors'] = $errors;
            echo json_encode($response);
            exit;
        }
    
        try {
            // Ajout du groupe dans la base de données
            $idGroupe = $this->addGroupe($nomGroupe, $modifiableParEtudiant);
            // Liaison des étudiants au groupe
            $this->lierEtudiantsAuGroupe($idGroupe, $etudiants);
    
            // $response['success'] = true;
            // $response['message'] = "Groupe ajouté avec succès !";
            // echo json_encode($response);
        } catch (PDOException $e) {
            // Gestion des erreurs SQL
            error_log("Erreur lors de l'ajout du groupe : " . $e->getMessage());
            $response['success'] = false;
            $response['message'] = "Une erreur est survenue lors de l'ajout du groupe.";
            echo json_encode($response);
        }
    }

    // AJOUTER UNE RESSOURCE

    // AJOUTER UNE SOUTENANCE

    public function ajouter_soutenance() {
        $errors = [];

        $nom_grp = isset($_POST["soutenance_nom_grp"]) ? $_POST["soutenance_nom_grp"] : null;
        $description = isset($_POST["soutenance_description"]) ? $_POST["soutenance_description"] : null;
        $sae = isset($_POST["soutenance_titre_sae"]) ? $_POST["soutenance_titre_sae"] : null;
        $date = isset($_POST["soutenance_dateSout"]) ? $_POST["soutenance_dateSout"] : null;
        $de = isset($_POST["soutenance_heure_debut"]) ? $_POST["soutenance_heure_debut"] : null;
        $a = isset($_POST["soutenance_heure_fin"]) ? $_POST["soutenance_heure_fin"] : null;
        $lieu = isset($_POST["soutenance_lieu"]) ? $_POST["soutenance_lieu"] : null;
        $jurys = isset($_POST["soutenance_jurys"]) ? $_POST["soutenance_jurys"] : null;
    
        if (!$this->groupe_existe($nomGroupe))
            $errors['nom_grp'] = "Le groupe n'existe pas.";
        else 
            $idGroupe = $this->get_groupe($nomGroupe)['idGroupe'];
    
        if (!$this->sae_existe($sae))
            $errors['sae'] = "La SAE n'existe pas.";
        else
            $idProjet = $this->get_id_sae($sae)['idProjet'];
        
        if (empty($date) || !$this->date_valide($date))
            $errors['dateSout'] = "La date est invalide ou déjà passée.";
    
        if (!empty($de) && !empty($lieu) && !empty($jurys)) {
            if (!$this->heure_debut_disponible($de, $date, $lieu, $jurys))
                $errors['heureDebut'] = "L'heure de début est déjà occupée pour cette salle ou par un jury.";
        }
    
        if (!empty($a) && !empty($lieu)) {
            if (!$this->heure_fin_disponible($a, $date, $lieu))
                $errors['heureFin'] = "L'heure de fin empiète sur une autre soutenance dans cette salle.";
        }
    
        foreach ($jurys as $jury_email) {
            if (!$this->jury_existe($jury_email)) {
                $errors['jurys'] = "Un des jurys sélectionnés n'existe pas.";
                break;
            }
        }
    
        if (!empty($errors))
            return $errors;
    
        $idGroupe = $this->get_groupe($nomGroupe)['idGroupe'];
        $idProjet = $this->get_id_sae($sae)['idProjet'];
        $idSout = $this->addSoutenance($description, $date, $de, $a, $lieu, $idGroupe, $idProjet);
    
        foreach ($jurys as $jury_email)
            $this->addJuryToSoutenance($idSout, $jury_email);
    
        return true;
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
        return self::$bdd->lastInsertId();
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
        $semestre = $_POST['semestre'];

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