<?php
//UserSession class has all logged user details, authenticates/authorizes logged users.
class UserSession {
    
    private $conn; // Explicitly declare the property
    public $id;
    public $uid;
    public $data;


    //authenticate is just a login part
    public static function authenticate($user, $pass) {
        $username = User::login($user, $pass);
        if($username){ 
            // creating new instance of User class so we can access all user infos like id, username, dob 
            $user = new User($username);
             $conn = Database::getConnection();
             $ip = $_SERVER['REMOTE_ADDR']; //user's ip
             $agent = $_SERVER['HTTP_USER_AGENT'];  //user's browser agent
             $token = md5(rand(0,9999999).$ip.$agent.time());
             $sql = "INSERT INTO `session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `active`)
             VALUES ('$user->id', '$token', now(), '$ip', '$agent', '1')";  //returns auth user id which is constructed at User class
             if($conn->query($sql)) {
                    Session::set('session_token', $token);           
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
        try {
            $session = new UserSession($token);
            if(isset($_SERVER['REMOTE_ADDR']) and isset($_SERVER['HTTP_USER_AGENT'])){
                if($session->isvalid() and $session->isActive()){
                    if($_SERVER['REMOTE_ADDR'] == $session->getIP()){
                        if($_SERVER['HTTP_USER_AGENT'] == $session->getUserAgent()){
                            Session::$user = $session->getUser();   // sets the new instance of user class 
                            return $session;    //returns the entire user session
                                                       
                        }else{
                            throw new Exception("User Agent Mismatch");
                        }
                    }else{
                        throw new Exception("IP Mismatch");
                    }
                }else{
                    $session->removeSession();
                    throw new Exception("Invalid session");
                }
        } else {
            throw new Exception("IP and User Agent is null");
        }
        } catch(Exception $e) {
           throw new Exception("Something went wrong".$e->getMessage());
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
            $this->uid = $row['uid'];  //Updating this from database
        }else {
            throw new Exception("Session Invalid.<br>");
        }    
    }

    public function getUser(){
        return new User($this->uid);    //returns new instance of User class
    }

    /*
    Check if the validity of the session is within one hour 
    */
    public function isValid()
    {
        if (isset($this->data['login_time'])) {
            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['login_time']);
            if (3600 > time() - $login_time->getTimestamp()) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception("login time is null");
        }
    }


    public function getIP() {
        return isset($this->data["ip"]) ? $this->data["ip"] : false;
    }

    public function getUserAgent() {
        return isset($this->data["user_agent"]) ? $this->data["user_agent"] : false;
        
    }

    public function deactive() {
        if(!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "UPDATE `session` SET `active` = '0' WHERE `uid` = `$this->uid";
        return $this->conn->query($sql) ? true : false;
    }

    public function isActive() {
        if(isset($this->data['active'])) {
            return $this->data['active'] ? true : false;
        }
    }

    //This function remove current session from the database.
    public function removeSession() {
        if(isset($this->data['id'])) {
            $id = $this->data['id'];
            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }
            $sql = "DELETE FROM `session` WHERE `id` = $id;";
            if ($this->conn->query($sql)) {
                return true;
            } else {
                return false;
            }
        }
    }
}

?>