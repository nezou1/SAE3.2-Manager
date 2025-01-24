<?php
require_once('../core/connexion.php');

class ModeleEvaluation {
    private $bdd;

    public function __construct() {
        $this->bdd = Connexion::getConnexion();
    }

    public function getSoutenanceById($idSoutenance) {
        $sql = "SELECT * FROM Soutenance WHERE idSoutenance = :idSoutenance";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['idSoutenance' => intval($idSoutenance)]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRenduById($idRendu) {
        $sql = "SELECT * FROM Rendu WHERE idRendu = :idRendu";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['idRendu' => intval($idRendu)]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function soumettreEvaluation($id, $type, $note, $commentaire, $coef, $idEns) {
        $sql = ($type === 'soutenance') ?
            "INSERT INTO Evaluation (note, commentaire, coef, idEns, idEval) VALUES (:note, :commentaire, :coef, :idEns, :id)" :
            "INSERT INTO Evaluation (note, commentaire, coef, idEns) VALUES (:note, :commentaire, :coef, :idEns)";

        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([
            'note' => floatval($note),
            'commentaire' => htmlspecialchars($commentaire),
            'coef' => floatval($coef),
            'idEns' => intval($idEns),
            'id' => intval($id)
        ]);
    }

    public function getNotesEtudiantSoutenance($idEtudiant) {
        $sql = "SELECT s.description, e.note, e.commentaire, e.coef
                FROM Evaluation e
                JOIN Soutenance s ON e.idEval = s.idSoutenance
                JOIN estDansLeGroupe edg ON s.idGroupe = edg.idGroupe
                WHERE edg.idEtud = :idEtudiant";

        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['idEtudiant' => intval($idEtudiant)]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recupererIdEnseignant($email) {
        $sql = "SELECT idEns FROM Enseignant WHERE email = :email";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['email' => htmlspecialchars($email)]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function recupererIdEtudiant($email) {
        $sql = "SELECT idEtud FROM Etudiant WHERE email = :email";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['email' => htmlspecialchars($email)]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
}
?>
