<?php
require_once(PROJECT_ROOT .'/core/connexion.php');
class ModeleGroupe extends Connexion {

    public function addGroupe($nom, $modifiableParEtudiant) {
        $bdd=Connexion::getConnexion();
        $sql = "INSERT INTO Groupe (nom, modifiable_par_etudiant) VALUES (:nom, :modifiable_par_etudiant)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'nom' => $nom,
            'modifiable_par_etudiant' => $modifiableParEtudiant
            
        ]);
    }

    public function getGroupes() {
        $bdd=Connexion::getConnexion();
        $sql = "SELECT * FROM Groupe";
        $stmt = $bdd->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
