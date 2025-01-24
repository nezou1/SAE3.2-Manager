<?php
require_once('../core/connexion.php');

class ModeleEvaluation {
    private $bdd;

    public function __construct() {
        $this->bdd = Connexion::getConnexion();
    }

    // Vérifie si une évaluation existe déjà pour une soutenance ou un rendu
    public function evaluationExists($id, $type) {
        if ($type === 'soutenance') {
            $sql = "SELECT COUNT(*) 
                    FROM Soutenance 
                    WHERE idSoutenance = :id AND idEval IS NOT NULL";
        } else {
            $sql = "SELECT COUNT(*) 
                    FROM Rendu 
                    WHERE idRendu = :id AND idEval IS NOT NULL";
        }

        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['id' => intval($id)]);
        return $stmt->fetchColumn() > 0;
    }

    // Soumet une évaluation pour une soutenance ou un rendu
    public function soumettreEvaluation($id, $type, $note, $commentaire, $coef, $idEns) {
        if ($this->evaluationExists($id, $type)) {
            die("Une évaluation existe déjà pour cet élément.");
        }

        try {
            $this->bdd->beginTransaction();

            // Insérer l'évaluation
            $sql = "INSERT INTO Evaluation (note, commentaire, coef, idEns) 
                    VALUES (:note, :commentaire, :coef, :idEns)";
            $stmt = $this->bdd->prepare($sql);
            $stmt->execute([
                'note' => floatval($note),
                'commentaire' => htmlspecialchars($commentaire, ENT_QUOTES, 'UTF-8'),
                'coef' => floatval($coef),
                'idEns' => intval($idEns)
            ]);

            // Récupérer l'ID de l'évaluation insérée
            $idEval = $this->bdd->lastInsertId();

            // Associer l'évaluation à la soutenance ou au rendu
            if ($type === 'soutenance') {
                $sql = "UPDATE Soutenance SET idEval = :idEval WHERE idSoutenance = :id";
            } else {
                $sql = "UPDATE Rendu SET idEval = :idEval WHERE idRendu = :id";
            }

            $stmt = $this->bdd->prepare($sql);
            $stmt->execute([
                'idEval' => intval($idEval),
                'id' => intval($id)
            ]);

            $this->bdd->commit();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            die("Erreur lors de l'insertion : " . $e->getMessage());
        }
    }

    // Récupérer les détails d'une soutenance par son ID
    public function getSoutenanceById($idSoutenance) {
        $sql = "SELECT s.*, e.note, e.commentaire, e.coef 
                FROM Soutenance s
                LEFT JOIN Evaluation e ON s.idEval = e.idEval
                WHERE s.idSoutenance = :idSoutenance";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['idSoutenance' => intval($idSoutenance)]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer les détails d'un rendu par son ID
    public function getRenduById($idRendu) {
        $sql = "SELECT r.*, e.note, e.commentaire, e.coef 
                FROM Rendu r
                LEFT JOIN Evaluation e ON r.idEval = e.idEval
                WHERE r.idRendu = :idRendu";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['idRendu' => intval($idRendu)]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer les notes d'un étudiant pour les soutenances
    public function getNotesEtudiantSoutenance($idEtudiant) {
        $sql = "SELECT s.description, e.note, e.commentaire, e.coef
                FROM Soutenance s
                JOIN Evaluation e ON s.idEval = e.idEval
                JOIN estDansLeGroupe edg ON s.idGroupe = edg.idGroupe
                WHERE edg.idEtud = :idEtudiant";

        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['idEtudiant' => intval($idEtudiant)]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer l'ID de l'enseignant via son email
    public function recupererIdEnseignant($email) {
        $sql = "SELECT idEns FROM Enseignant WHERE email = :email";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8')]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    // Récupérer l'ID de l'étudiant via son email
    public function recupererIdEtudiant($email) {
        $sql = "SELECT idEtud FROM Etudiant WHERE email = :email";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8')]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    // Mettre à jour une évaluation existante
    public function updateEvaluation($idEval, $note, $commentaire, $coef) {
        $sql = "UPDATE Evaluation 
                SET note = :note, commentaire = :commentaire, coef = :coef 
                WHERE idEval = :idEval";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([
            'idEval' => intval($idEval),
            'note' => floatval($note),
            'commentaire' => htmlspecialchars($commentaire, ENT_QUOTES, 'UTF-8'),
            'coef' => floatval($coef)
        ]);
    }

    // Supprimer une évaluation
    public function deleteEvaluation($idEval) {
        $sql = "DELETE FROM Evaluation WHERE idEval = :idEval";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['idEval' => intval($idEval)]);
    }
}
?>
