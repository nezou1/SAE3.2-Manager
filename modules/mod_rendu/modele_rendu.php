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
        $sql = "SELECT s.* FROM Soutenance s
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
                INNER JOIN Depot d ON r.idDepot = d.idDepot
                INNER JOIN estAssigneComme eac ON d.idProjet = eac.idProjet
                WHERE eac.idEns = :idEns";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['idEns' => $idEns]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function creerDepot($descriptif, $dateAttendu, $idProjet) {
        $bdd = Connexion::getConnexion();
        $sql = "INSERT INTO Depot (descriptif, dateAttendu, idProjet) VALUES (:descriptif, :dateAttendu, :idProjet)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'descriptif' => $descriptif,
            'dateAttendu' => $dateAttendu,
            'idProjet' => $idProjet
        ]);
    }

    public function getRenduById($idRendu) {
        $bdd = Connexion::getConnexion();
        $sql = "SELECT * FROM Rendu WHERE idDepot = :idRendu";
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
}
?>