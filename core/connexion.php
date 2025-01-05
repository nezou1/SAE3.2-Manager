<?php

require_once 'config.php';
class Connexion {
    protected static $bdd;

    public static function initConnexion() {
        try{
            self::$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
            exit;
        }
    }

    public static function getConnexion() {
        return self::$bdd;
    }
}
