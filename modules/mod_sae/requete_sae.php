<?php
class RequetesSQL {

    public static $queries = [
        "id_enseignant" => "SELECT idEns FROM Enseignant WHERE email = :email",
        "id_etudiant" => "SELECT idEtud FROM Etudiant WHERE email = :email",
        
        "inserer_projet" => "INSERT INTO Projet (titre, description, annee, semestre) VALUES (?, ?, ?, ?)",
        "inserer_enseignant" => "INSERT INTO estAssigneComme (idEns, idProjet, role) VALUES (?, ?, ?)",
        "inserer_ressource" => "INSERT INTO Ressource (titre, type, url, mise_en_avant, idProjet) VALUES (?, ?, ?, '?', ?)",
        "inserer_groupe" => "INSERT INTO Groupe (nom, imageTitre, modifiable_par_etudiant) VALUES (:nom, NULL, :modifiable_par_etudiant)",
        "lier_etud_au_groupe" => "INSERT INTO estDansLeGroupe (idGroupe, idEtud) VALUES (:idGroupe, :idEtud)",
        "lier_groupe_a_projet" => "INSERT INTO estDansCeProjet (idProjet, idGroupe) VALUES (? , ?)",


        "dissocier_groupe_sae" => "DELETE FROM estDansCeProjet WHERE idGroupe = ?",
        "dissocier_groupe_etudiant" => "DELETE FROM estDansLeGroupe WHERE idGroupe = ?",
        "supprimer_groupe" => "DELETE FROM Groupe WHERE idGroupe = ?",

        
        "get_titre_sae" => "SELECT titre FROM Projet WHERE titre = ?",
        "get_saes_ens" => "SELECT Projet.idProjet, titre, description, annee, semestre
                            FROM Projet JOIN estAssigneComme eA ON Projet.idProjet = eA.idProjet
                            WHERE idEns = ?", 
        "get_saes_etud" => "SELECT Projet.idProjet, titre, description, annee, semestre
                            FROM Projet
                            JOIN estDansCeProjet eDcP ON Projet.idProjet = eDcP.idProjet
                            JOIN estDansLeGroupe eDlG ON eDcP.idGroupe = eDlG.idGroupe
                            WHERE idEtud = ?",
        "get_projet" => "SELECT titre, description, annee, semestre
                             FROM Projet 
                             WHERE idProjet = ?",
        "get_ressources" => "SELECT res.titre, res.type, res.url, res.mise_en_avant
                                 FROM Ressource res
                                 NATURAL JOIN Projet",
        "liste_enseignant" => "SELECT email
                                FROM Enseignant
                                WHERE email NOT IN (
                                    SELECT email
                                    FROM Enseignant
                                    WHERE email = :email_resp
                                )",
        "get_enseignants_sae" => "SELECT nom, prenom
                               FROM estAssigneComme
                               JOIN Enseignant USING(idEns)
                               WHERE idProjet = ?",
        "get_ressources_sae" => "SELECT titre, mise_en_avant
                                 FROM Ressource
                                 WHERE idProjet = ?",
        "get_groupes_sae" => "SELECT idGroupe, nom, modifiable_par_etudiant
                              FROM Groupe
                              JOIN estDansCeProjet USING (idGroupe)
                              WHERE idProjet = ?",
        "get_etudiants_sans_grp" => "SELECT e.idEtud, e.nom, e.prenom
                                     FROM Etudiant e
                                     WHERE idEtud NOT IN (
                                        SELECT idEtud 
                                        FROM estDansLeGroupe 
                                        JOIN estDansCeProjet USING (idGroupe)
                                        WHERE idProjet = ?
                                     )",
        "get_etudiants_grp" => "SELECT idEtud, nom, prenom
                                FROM Etudiant
                                JOIN estDansLeGroupe USING (idEtud)
                                WHERE idEtud = ?",
        "get_rendus_sae" => "SELECT idRendu, descriptif, dateAttendu, dateEnvoyee
                             FROM Rendu
                             JOIN Evaluation USING (Rendu)
                             WHERE idProjet = ? AND idGroupe = ?",
        "get_soutenances_sae" => "SELECT s.idSoutenance, s.description, dateSout, lieu, heureDebut, heureFin, nom as nom_groupe, titre as titre_sae
                                  FROM Groupe
                                  JOIN Soutenance s USING (idGroupe)
                                  JOIN Projet p ON s.idProjet = p.idProjet
                                  WHERE s.idProjet = ?
                                  ORDER BY dateSout, heureDebut",
        "get_jury" => "SELECT nom
                       FROM Enseignant
                       NATURAL JOIN estJury
                       WHERE idSoutenance = ?"
                                 
    ];
}
?>