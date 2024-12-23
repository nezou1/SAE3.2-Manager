<?php

class ModeleSoutenance extends Connexion {

    public function get_soutenances() {
        $req = "SELECT distinct idSoutenance, Groupe.nom as nom_groupe, Soutenance.description, titre as sae, dateSout, heureDebut, heureFin, lieu
                    FROM Enseignant natural join estJury join Soutenance using (idSoutenance) join Groupe using (idGroupe) join Projet ON Soutenance.idProjet = Projet.idProjet
                    ORDER BY dateSout, heureDebut";
        $pdo_req = self::$bdd->query($req);
		$soutenances = $pdo_req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($soutenances as &$soutenance) {
            $soutenance['jurys'] = $this->getJurysBySoutenanceId($soutenance['idSoutenance']);
        }
        return $soutenances;
    }
    
    private function getJurysBySoutenanceId($id) {
        $request = "SELECT enseignant.nom
            FROM Enseignant
            NATURAL JOIN estJury
            WHERE idSoutenance = ?";
        $pdo_req = $pdo->prepare($request);
        $pdo_req->execute([$id]);
        return $pdo_req->fetchAll(PDO::FETCH_COLUMN); // Récupère uniquement les noms des jurys
    }

    public function ajout($nomGroupe, $description, $sae, $date, $de, $a, $lieu, $jurys) {
        $errors = [];
    
        if (!$this->groupe_existe($nomGroupe))
            $errors['nom_groupe'] = "Le groupe n'existe pas.";
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
    
        foreach ($jurys as $juryEmail) {
            if (!$this->jury_existe($juryEmail)) {
                $errors['jurys'] = "Un des jurys sélectionnés n'existe pas.";
                break;
            }
        }
    
        if (!empty($errors))
            return $errors;
    
        $idGroupe = $this->get_groupe($nomGroupe)['idGroupe'];
        $idProjet = $this->get_id_sae($sae)['idProjet'];
        $idSout = $this->addSoutenance($description, $date, $de, $a, $lieu, $idGroupe, $idProjet);
    
        foreach ($jurys as $juryEmail)
            $this->addJuryToSoutenance($idSout, $juryEmail);
    
        return true;
    }

    // Add
    
    public function addSoutenance($description, $date, $de, $a, $lieu, $idGroupe, $idProjet) {
        $req = "INSERT INTO Soutenance (description, dateSout, lieu, heureDebut, heureFin, idGroupe, idProjet)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute([$description, $date, $lieu, $de, $a, $idGroupe, $idProjet]);
        return self::$bdd->lastInsertId();
    }
    
    public function addJuryToSoutenance($idSoutenance, $idEns) {
        $req = "INSERT INTO estJury (idSoutenance, idEns) VALUES (?, ?)";
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute([$idSoutenance, $idEns]);
    }

    // Getters

    public function get_groupe($nomGroupe){
        $req= self::$bdd->prepare("SELECT idGroupe FROM Groupe WHERE nom = ?");
		$req->execute([$nomGroupe]);
		return $req->fetch();
    }

    public function get_id_sae($titre){
        $req= self::$bdd->prepare("SELECT idProjet FROM Projet WHERE titre = ?");
		$req->execute([$titre]);
		return $req->fetch();
    }

    // Méthodes de vérifications

    public function groupe_existe($nomGroupe){
        $req= self::$bdd->prepare("SELECT * FROM Groupe WHERE nom = ?");
		$req->execute([$nomGroupe]);
		return $req->row_count() > 0 ? true : false; 
    }

    public function sae_existe($titre){
        $req= self::$bdd->prepare("SELECT * FROM Projet WHERE titre = ?");
		$req->execute([$titre]);
		return $req->row_count() > 0 ? true : false;
    }

    public function enseignant_existe($nomEns){
        $req= self::$bdd->prepare("SELECT * FROM Enseignant WHERE nom = ?");
		$req->execute([$nomEns]);
		return $req->row_count() > 0 ? true : false;
    }

    public function date_valide($date) {
        $aujourdhui = date('Y-m-d');
        return $date >= $aujourdhui;
    }
    
    public function heure_debut_disponible($heureDebut, $date, $lieu, $jurys) {
        // Vérifie si l'heure de début n'est pas déjà prise dans la même salle ou par un jury similaire
        $req = "
            SELECT s.idSoutenance 
            FROM Soutenance s 
            JOIN estJury e ON s.idSoutenance = e.idSoutenance
            WHERE s.dateSout = ? 
              AND (s.lieu = ? OR e.idEns IN (" . implode(',', array_fill(0, count($jurys), '?')) . "))
              AND s.heureDebut <= ? 
              AND s.heureFin > ?";
        $params = array_merge([$date, $lieu, $heureDebut, $heureDebut], $jurys);
    
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute($params);
    
        return $pdo_req->rowCount() === 0;
    }
    
    public function heure_fin_disponible($heureFin, $date, $lieu) {
        // Vérifie si l'heure de fin n'empiète pas sur une autre soutenance de la même salle
        $req = "
            SELECT idSoutenance 
            FROM Soutenance 
            WHERE dateSout = ? 
              AND lieu = ? 
              AND heureDebut < ? 
              AND heureFin > ?";
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute([$date, $lieu, $heureFin, $heureFin]);
    
        return $pdo_req->rowCount() === 0;
    }
    
    public function jury_existe($emailJury) {
        $req = "SELECT * FROM Enseignant WHERE nom = ?";
        $pdo_req = self::$bdd->prepare($req);
        $pdo_req->execute([$emailJury]);
        return $pdo_req->rowCount() > 0;
    }
    
}
?>