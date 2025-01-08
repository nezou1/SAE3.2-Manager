<?php 
    class Connexion{
        protected static $bdd;

        public static function initConnexion(){
            self::$bdd=new PDO(
                'mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201629',
                "dutinfopw201629",
                "nedyjunu"
            );
        }
    }
?>