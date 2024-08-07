<?php

class User{
   
    public $conn;
    public $username; // Declare the username property
    public $id; // Declare the id property   
    
    //_call fun will be called if the called function(method) is not avalilabe in the class(like switchcase default in py)
    public function __call($name,$arguments){  
        //Removes non-alphanumeric characters from the substring starting at the 4th character of $name.
        //substr simply cuts a str into a represented index
        $property = preg_replace("/[^0-9a-zA-Z]/","",substr($name, 3)); 
        //Converts camelCase to snake_case by inserting an underscore before capital letters.
        $property = strtolower(preg_replace('/\B([A-Z])/','_$1',$property));    
        if(substr($name,0,3) == 'get'){ 
            return $this->_get_data($property);
        }elseif(substr($name,0,3) == 'set'){
            return $this->_set_data($property,$arguments[0]);      //$arguments[0]->first argument provided to the originally called method is being used as the value to set.
            
        }else{
            //in __call fun if we call any undeclared function in a class if simply omits the arguments which has passed, without throwing error.
            //so we are throwing exception for that un arguments passed for debugging purpose*.
            throw new Exception("User::_call() -> $name, function unavailable.");
        }
    }
    
    public static function signup($user,$pass,$email,$phone){
        //connection is fetches from Database.class.php
        $conn = Database::getconnection();  
        $options = [
            'cost' => 9,
        ];
        $pass = password_hash($pass,PASSWORD_BCRYPT,$options);
        $sql = "INSERT INTO `auth` (`username`, `password`, `email`, `phone`, `block`, `active`)    
        VALUES ('$user', '$pass', '$email', '$phone', '0', '1')";  
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
        //returns true/false (redirects to _sighup.php)
        return $error; 
    }

    public static function login($user,$pass){
        $conn = Database::getConnection();
        $query = "SELECT * FROM `auth` WHERE `username` = '$user'"; 
        $result = $conn->query($query);
        if($result->num_rows == 1){     // Checks if the result set contains no.of rows == 1
            $row = $result->fetch_assoc();      //fetch_assoc() ->returns the datas in the form of associative array. 
            if(password_verify($pass,$row['password'])){
                return $row['username'];
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    //fetches the username by the initialization of signup object of User class at signup form
    //_construct fetches id of loged user via their username else throws error.
    public function __construct($username){
       // print($username);  
        $this->conn = Database::getConnection();
        $this->username = $username;
        $this->id = null;
        $sql = "SELECT `id` FROM `auth` WHERE `username` = '$username' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc(); 
            $this->id = $row['id']; //update this from database
        }else{
            throw new exception("Username Not Found :( ");
        }
    }

    //this function  helps to retrive data from database
    public function _get_data($var){
        if(!$this->conn){
            $this->conn = Database::getConnection();
        }
        $sql = "SELECT `$var` FROM `users` WHERE `id` = '$this->id'"; 
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            return $result->fetch_assoc()["$var"];      //retrieves the specified key value
        }else{
            return null;
        }
    }

    //this function  helps to set data in the database
    public function _set_data($var, $data){
        if(!$this->conn){
            $this->conn = Database::getConnection();
        }
        $sql = "UPDATE `users` SET `$var` = '$data' WHERE `id` = '$this->id'";  
        if($this->conn->query($sql)){
            return true; 
        }else{
            return false;
        }
    }
  
    //overrided dob
    public function setDob($year, $month, $day){
        if(checkdate($month, $day, $year)){     
            return $this->__set('dob',"$year-$month-$day");
        }else{
            return false;
        }
    }

    //overrided username
    public function getUsername(){      
        return $this->username;
    }

    public function authenticate()
    {
    }
    


}


?>