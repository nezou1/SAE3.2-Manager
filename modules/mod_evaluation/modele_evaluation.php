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
        $sql = "SELECT * FROM Rendu WHERE idRendu = :idRendu";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idRendu' => $idRendu]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function evaluationExists($id, $type) {
        $bdd = Connexion::getConnexion();
        if ($type == 'soutenance') {
            $sql = "SELECT COUNT(*) FROM Evaluation WHERE idSoutenance = :id";
        } else {
            $sql = "SELECT COUNT(*) FROM Evaluation WHERE idRendu = :id";
        }
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchColumn() > 0;
    }

    public function soumettreEvaluation($id, $type, $note, $commentaire, $coef, $idEns) {
        if ($this->evaluationExists($id, $type)) {
            echo "Une évaluation existe déjà pour ce projet.";
        }
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
}
?>