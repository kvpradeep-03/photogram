<?php

class UserSesion {
    
    public $id;
    public $uid;
    public $data;

    public static function authenticate($user, $pass) {
        $username = User::login($user, $pass);
        if($username){
             $conn = Database::getConnection();
             $ip = $_SERVER['REMOTE_ADDR'];
             $agent = $_SERVER['HTTP_USER_AGENT'];
             $token = md5(rand(0,9999999).$ip.$agent.time());
             $sql = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `active`)
             VALUES ('$user->id', '$token', now(), '$ip', '$agent', '1')";  //returns auth user id which is constructed at User class
             if($conn->query($sql)){
                    Session::set('session_token', $token);
                    return $token;
             }else {
                return false;
             }
             
        }else{
            return false;
        }
    }
    public function __construct($id){
        $this->conn = Database::getConnection();
        $this->id = id;
        $this->data = null;
        $sql = "SELECT * FROM `session` WHERE `id` = '$id' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_row == 1){
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['id'];
        }else {
            throw new Exception("Session Invalid.");
        }    


    }
}

?>