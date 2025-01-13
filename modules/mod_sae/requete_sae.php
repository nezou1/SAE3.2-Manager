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
        "id_intervenant" => "SELECT idEns FROM Enseignant WHERE email = ?",
        "get_titre_sae" => "SELECT titre FROM Projet WHERE titre = ?",
        "inserer_projet" => "INSERT INTO Projet (titre, description, annee, semestre) VALUES (?, ?, ?, ?)",
        "inserer_intervenant" => "INSERT INTO estAssigneComme (idEns, idProjet, role) VALUES (?, ?, \'intervenant\')",
        "inserer_ressource" => "INSERT INTO Ressource (titre, type, url, mise_en_avant, idProjet) VALUES (?, ?, ?, ?, ?)",
    ];
}
?>