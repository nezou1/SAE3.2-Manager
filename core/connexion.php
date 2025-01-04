<?php

require_once 'config.php';
class Connexion {
    private static $bdd;

    public static function initConnexion() {
        if (!self::$bdd) {
            self::$bdd = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    public static function getConnexion() {
        return self::$bdd;
    }
}
