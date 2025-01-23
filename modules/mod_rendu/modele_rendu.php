<?php
class ModeleRendu extends Connexion
{

    public function recupererIdEnseignant($email) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT idEns FROM Enseignant WHERE email = :email";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getSoutenancesByEnseignant($email) {
        $bdd = Connexion::getConnexion();
        $idEns = $this->recupererIdEnseignant($email)['idEns'];
        $sql = "SELECT * FROM Soutenance s
                INNER JOIN estJury ej ON s.idSoutenance = ej.idSoutenance
                WHERE ej.idEns = :idEns";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idEns' => $idEns]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRendusByEnseignant($email) {
        $bdd = Connexion::getConnexion();
        $idEns = $this->recupererIdEnseignant($email)['idEns'];
        $sql = "SELECT r.* FROM Rendu r
                INNER JOIN Projet p ON r.idProjet = p.idProjet
                INNER JOIN estAssigneComme eac ON p.idProjet = eac.idProjet
                WHERE eac.idEns = :idEns";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idEns' => $idEns]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function soumettreEvaluation($id, $type, $note, $commentaire, $coef, $idEns) {
        $bdd = Connexion::getConnexion();
        if ($type == 'soutenance') {
            $sql = "INSERT INTO Evaluation (note, commentaire, coef, idEns, idSoutenance) VALUES (:note, :commentaire, :coef, :idEns, :id)";
        } else {
            $sql = "INSERT INTO Evaluation (note, commentaire, coef, idEns, idRendu) VALUES (:note, :commentaire, :coef, :idEns, :id)";
        }
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'note' => $note,
            'commentaire' => $commentaire,
            'coef' => $coef,
            'idEns' => $idEns,
            'id' => $id
        ]);
    }

    public function getRenduById($idRendu) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT * FROM Rendu WHERE idRendu = :idRendu";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idRendu' => $idRendu]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getSoutenanceById($idSoutenance) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT * FROM Soutenance WHERE idSoutenance = :idSoutenance";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idSoutenance' => $idSoutenance]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function creerRendu($titre, $description, $date, $fileUpload) {
        $bdd = Connexion::getConnexion();
        $sql = "INSERT INTO Rendu (titre, description, date, fileUpload) VALUES (:titre, :description, :date, :fileUpload)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'titre' => $titre,
            'description' => $description,
            'date' => $date,
            'fileUpload' => $fileUpload
        ]);
    }



}
?>
