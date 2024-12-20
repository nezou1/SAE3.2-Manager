<?php

class ModeleSoutenance extends Connexion {

    public function get_planning() {
        $request = "SELECT distinct idSoutenance, groupe.nom as nom_groupe, description, titre as sae, dateSout, heureDebut, heureFin, lieu
                    FROM Enseignant natural join estJury join Soutenance using (idSoutenance) join Groupe using (idGroupe) join Projet ON soutenance.idProjet = projet.idProjet
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

    // public function ajout ($nomGroupe, $description, $sae, $date, $de, $a, $lieu, $jurys) {
    //     $req1 = "INSERT INTO Soutenance (description,dateSout, lieu, heureDebut, heureFin, idGroupe, idProjet)
    //             VALUES (:description, :dateSout, :lieu, :heureDebut, :heureFin, :idGroupe, :idProjet)"
	// 	$req = "INSERT INTO Joueur (nom, biographie) VALUES (:nom, :biographie)";
	// 	$pdo_req = self::$bdd->prepare($req);
	// 	$pdo_req->bindParam("nom", $nom);
	// 	$pdo_req->bindParam("biographie", $biographie);
	// 	$pdo_req->execute();
	// 	if ($pdo_req->rowCount() != 0)
	// 		return true;
	// 	else 
	// 		return false;
	// }

    // public function verifExistance_groupe($nomGroupe){
    //     $req= self::$bdd->prepare("SELECT idGroupe FROM Groupe WHERE nom = ?");
	// 	$req->execute([$nomGroupe]);
	// 	return $req->fetch();
    // }

    // public function verifExistance_SAE($titre){
    //     $req= self::$bdd->prepare("SELECT idProjet FROM Projet WHERE titre = ?");
	// 	$req->execute([$titre]);
	// 	return $req->fetch();
    // }

    // public function verifExistance_enseignant($nomEns){
    //     $req= self::$bdd->prepare("SELECT * FROM Enseignant WHERE nom = ?");
	// 	$req->execute([$nomEns]);
	// 	return $req->fetch();
    // }
}
?>