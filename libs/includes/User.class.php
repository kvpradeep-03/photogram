<?php

class User{
    private $conn;
    public static function signup($user,$pass,$email,$phone){
        $pass = md5($pass); //hashes the password while saving in db
        $conn = Database::getconnection();  //connection is fetches from Database.class.php
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `block`, `active`)    
        VALUES ('$user', '$pass', '$email', '$phone', '0', '1')";   //inserting the data's into sql table
        $error = false;
        try {
            //checks inserted query status(true/false)
            //$sql has the username,pass,email such details of signuping users.
            if($conn->query($sql) === true) { 
            $error = false;
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            $error = true;
            throw new Exception ($conn->error); 
        } 
        } catch (Exception $e){
            $error = $e->getMessage();
        }
    
        // $conn->close();
        return $error; //returns true/false (redirects to _sighup.php)
    
        
    }

    public static function login($user,$pass){
        $pass = md5($pass); //while the $pass var fetches this line it hashes into(32 bit char) after hashing even we can know what's the real pass is.
        $query = "SELECT * FROM `auth` WHERE `username` = '$user'"; //selects username from db
        $conn = Database::getConnection();
        $result = $conn->query($query);
        if($result->num_rows == 1){ // Checks if the result set contains any rows
            $row = $result->fetch_assoc();  //fetch_assoc() ->returns the datas in the form of associative array.
            if($row['password'] == $pass){
                return $row;    //returns the entire particular row.
            }else{
                return false;
            }
        }else{
            return false;
        }


    }
}


?>