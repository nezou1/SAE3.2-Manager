<?php
class ModeleEvaluation extends Connexion
{
    public function getSoutenanceById($idSoutenance) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT * FROM Soutenance WHERE idSoutenance = :idSoutenance";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idSoutenance' => $idSoutenance]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRenduById($idRendu) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT * FROM Rendu WHERE idDepot = :idRendu";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idRendu' => $idRendu]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function evaluationExists($id, $type) {
        $bdd = Connexion::getConnexion();
        if ($type == 'soutenance') {
            $sql = "SELECT COUNT(*) FROM Evaluation WHERE idEval = :id AND idSoutenance IS NOT NULL";
        } else {
            $sql = "SELECT COUNT(*) FROM Evaluation WHERE idEval = :id AND idDepot IS NOT NULL";
        }
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchColumn() > 0;
    }

    public function soumettreEvaluation($id, $type, $note, $commentaire, $coef, $idEns) {
        $bdd = Connexion::getConnexion();
        if ($type == 'soutenance') {
            $sql = "INSERT INTO Evaluation (note, commentaire, coef, idEns) VALUES (:note, :commentaire, :coef, :idEns)";
        } else {
            $sql = "INSERT INTO Evaluation (note, commentaire, coef, idEns) VALUES (:note, :commentaire, :coef, :idEns)";
        }
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'note' => $note,
            'commentaire' => $commentaire,
            'coef' => $coef,
            'idEns' => $idEns
        ]);
    }

    public function getNotesEtudiantSoutenance($idEtudiant) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT s.description, e.note, e.commentaire, e.coef
                FROM Evaluation e
                JOIN Soutenance s ON e.idEval = s.idEval
                JOIN estDansLeGroupe edg ON s.idGroupe = edg.idGroupe
                WHERE edg.idEtud = :idEtudiant";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idEtudiant' => $idEtudiant]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>