<?php

class User{
   
    private $conn;
    //private static $salt = "bfqdq%ijspiq@vnk!b&fds*dca#vafva";  //cryptographic hashing -> a salt is a random value added to a password before hashing it. The purpose of using a salt is to enhance the security
    
    public static function signup($user,$pass,$email,$phone){
        $conn = Database::getconnection();  //connection is fetches from Database.class.php
        //$pass = md5($pass).User::$salt; //hashes the password while saving in db
        $options = [
            'cost' => 9,
        ];
        $pass = password_hash($pass,PASSWORD_BCRYPT,$options);
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
        $conn = Database::getConnection();
        $query = "SELECT * FROM `auth` WHERE `username` = '$user'"; //selects username from db
        $result = $conn->query($query);
        if($result->num_rows == 1){ // Checks if the result set contains any rows
            $row = $result->fetch_assoc();  //fetch_assoc() ->returns the datas in the form of associative array.
            //if($row['password'] == $pass){
            if(password_verify($pass,$row['password'])){
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