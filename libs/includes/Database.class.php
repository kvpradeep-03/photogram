<?php
 
 class Database{
    public static $conn = null; //checkes the connection is empty?
    public static function getConnection(){
        if(Database::$conn == null){    //at initial new connection the $conn ->obeviously empty
            $servername = "mysql.selfmade.ninja";
            $username = "photogram_db";
            $password = "prad2003";
            $dbname = "photogram_db_auth";

            // Create connection
            //$connection -> An instance of the mysqli class, which is used to connect to a MySQL database.
            $connection = new mysqli($servername, $username, $password, $dbname);    
            // Check connection
            //->connect_error -> A property of the mysqli object.If the connection attempt fails,this property contains a string describing the error that occurred.
            if ($connection->connect_error) {   
            die("Connection failed: " . $connection->connect_error);
            }else{
                Database::$conn = $connection;  //replacing null with actual connection (server connection information status)
                return Database::$conn;
            }   

        }else{
            return Database::$conn;
        }
    }
 }

?>