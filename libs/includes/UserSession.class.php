<?php

class UserSession {
    
    private $conn; // Explicitly declare the property
    public $id;
    public $uid;
    public $data;


    //authenticate is just a login part
    public static function authenticate($user, $pass) {
        //$username = User::login($user, $pass); //if we use like this it loops b/w login and authenticate functions.
        //$user = new User($username);    //returns id of username from auth table
        $user = new User($user);
        if($user){ //here it passes id instead of username so it throes error
             $conn = Database::getConnection();
             $ip = $_SERVER['REMOTE_ADDR']; //user's ip
             $agent = $_SERVER['HTTP_USER_AGENT'];  //user's browser agent
             $token = md5(rand(0,9999999).$ip.$agent.time());
             $sql = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `active`)
             VALUES ('$user->id', '$token', now(), '$ip', '$agent', '1')";  //returns auth user id which is constructed at User class
             if($conn->query($sql)) {
                    Session::set('session_token', $token);
                    UserSession::authorize($token);
                    return $token;
             }else {
                return false;
             }
             
        }else{
            return false;
        }
    }
    
    //authorize is like authentication(verification) of loged user to enable their activities in a page.
    public static function authorize($token) {
        //$sess = new UserSession($token);
        //do the task provided in logintest.php
        if(Session::isset('session_token')){
            $sess = new UserSession($token);
            if ($sess !== null && $sess->isValid()) {
                echo "Session validated <br>";

            }else{
                echo "Session invalid ,Please <a href='logintest.php'>login again</a> <br>";
            }

        } else {
            echo "Session token not found. Please <a href='logintest.php'>login again</a> <br>";
        }
    }

    public function __construct($token) {
        $this->conn = Database::getConnection();
        $this->data = null;
        $sql = "SELECT * FROM `session` WHERE `token` = '$token' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid']; 
        }else {
            throw new Exception("Session Invalid.<br>");
        }    
    }

    public function getUser(){
        return new User($this->id);
    }

    /*
    Check if the validity of the session is within one hour else it inactive.
    */
    public function isvalid() {
        $logTime = strtotime($this->data['login_time']); //converts textual time into unixtimestamp.
        $currentTime = time();
        $diff = $currentTime - $logTime;
        
        return $diff <3600; //1h=3600s returns (bool)
    }

    public function getIP() {
        return $this->data['ip'];
    }

    public function getUserAgent() {
        return $this->data['user_agent'];
        
    }

    public function deactive() {
        
    }
}

?>