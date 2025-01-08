<?php

class Database {
    protected static $bdd;

    public static function initConnexion() {
        try {
            self::$bdd = new PDO(
                'mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201629',
                'dutinfopw201629',
                'nedyjunu'
            );
            self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            self::$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    public static function getConnexion() {
        if (self::$bdd === null) {
            self::initConnexion();
        }
        return self::$bdd;
    }
}
?>
