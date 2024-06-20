<?php
 
 class Database{
    public static $conn = null;
    public static function getConnection(){
        if(Database::$conn == null){
            $servername = "mysql.selfmade.ninja";
            $username = "photogram_db";
            $password = "prad2003";
            $dbname = "photogram_db_auth";

            // Create connection
            $connection = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
            }else{
                echo "connection established.";
                Database::$conn = $connection;  //replacing null with actual connection
                return Database::$conn;
            }   

        }else{
            echo "Re establishing the connection .";
            return Database::$conn;
        }
    }
 }

?>