<?php

class User{
    public static function signup($user,$pass,$email,$phone){
    
        $conn = Database::getconnection();  //connection is fetches from Database.class.php
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `block`, `active`)    
        VALUES ('$user', '$pass', '$email', '$phone', '0', '1')";   //inserting the data's into sql table
        $error = false;
        try {
            //checks inserted query status(true/false)
            if($conn->query($sql) === true) { 
            $error = false;
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            $error = true;
            throw new Exception ($conn->error); 
        } 
        } catch (Exception $e){
            $error = $e->getMessage();
            //return $err
        }
    
        // $conn->close();
        return $error; //returns true/false (redirects to _sighup.php)
    
        
    }
}


?>