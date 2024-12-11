<?php
 
 class Database{
    //checkes the connection is empty?
    public static $conn = null; 
    public static function getConnection(){
        //at initial new connection the $conn ->obeviously empty
        if(Database::$conn == null){ 
            //get_config function loads in load.php  
            $servername = get_config('db_server');
            $username = get_config('db_username');
            $password = get_config('db_password');
            $dbname = get_config('db_name');

            // Create connection
            //$connection -> An instance of the mysqli class, which is used to connect to a MySQL database.
            $connection = new mysqli($servername, $username, $password, $dbname);    
            // Check connection
            //->connect_error -> A property of the mysqli object.If the connection attempt fails,this property contains a string describing the error that occurred.
            if ($connection->connect_error) {   
            die("Connection failed: " . $connection->connect_error);
            }else{
                //replacing null with actual connection (server connection information status)
                Database::$conn = $connection; 
                return Database::$conn;
            }   

        }else{
            return Database::$conn;
        }
    }
 }
 
?>