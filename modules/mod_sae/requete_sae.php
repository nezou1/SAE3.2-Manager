<?php
class RequetesSQL {

    public static $queries = [
        "liste_enseignant" => "SELECT email
                                FROM Enseignant
                                WHERE email NOT IN (
                                    SELECT email
                                    FROM Enseignant
                                    WHERE email = :email_resp
                                )",
        "id_enseignant" => "SELECT idEns FROM Enseignant WHERE email = :email",
        "id_etudiant" => "SELECT idEtud FROM Etudiant WHERE email = :email",
        "get_titre_sae" => "SELECT titre FROM Projet WHERE titre = ?",
        "inserer_projet" => "INSERT INTO Projet (titre, description, annee, semestre) VALUES (?, ?, ?, ?)",
        "inserer_enseignant" => "INSERT INTO estAssigneComme (idEns, idProjet, role) VALUES (?, ?, ?)",
        "inserer_ressource" => "INSERT INTO Ressource (titre, type, url, mise_en_avant, idProjet) VALUES (?, ?, ?, '?', ?)",
        "get_saes_ens" => "SELECT Projet.idProjet, titre, description, annee, semestre
                            FROM Projet JOIN estAssigneComme eA ON Projet.idProjet = eA.idProjet
                            WHERE idEns = ?", 
        "get_saes_etud" => "SELECT Projet.idProjet, titre, description, annee, semestre
                            FROM Projet
                            JOIN estDansCeProjet eDcP ON Projet.idProjet = eDcP.idProjet
                            JOIN estDansLeGroupe eDlG ON eDcP.idGroupe = eDlG.idGroupe
                            WHERE idEtud = ?",
    ];
}
?>