<?php 
    require_once("config.php");

    class DB{
        private static $pdo;

        public static function startDB(){
            if (!isset(self::$pdo)) {
                try {
                    self::$pdo = new PDO("mysql:host=".SERVER.";dbname=".DATABASE, USER, PASSWORD);
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                } catch (PDOException $error) {
                    echo "Failed to connect to database".$error->getMessage();
                }
            }
            return self::$pdo;

        }

        public static function prepare($sql){
            return self::startDB()->prepare($sql);
        }
    }
?>