<?php
//include mannually since it didn't works at lib includes.
include_once __DIR__ . "/../traits/SQLGetterSetter.trait.php";

//User class has login,signup functions and sets/gets user datas from auth table.
class User{
    
    use SQLGetterSetter;
    private $conn;
    public $username; // Declare the username property (auth table username)
    public $id; // Declare the id property (auth table id)  
    public $table; // Declare the table property (auth table name) for SQLGetterSetter trait

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
    
    // User object can be constructed by both userId and username.
    // fetches the username by UserSession::authenticate();
    public function __construct($username){
        $this->conn = Database::getConnection();
        $this->username = $username;
        $this->id = null;
        $this->table = 'auth';
        $sql = "SELECT `id` FROM `$this->table` WHERE `username` = '$username' OR `id` = '$username' LIMIT 1"; //`id` = $id
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc(); 
            $this->id = $row['id']; //instead of returning we are saving the id in User class itself.
        }else{
            throw new Exception("Username Not Found :( ");
        }
    }

    
    //if any issues in get and set data remove overrided functions 
    //overrided dob
    public function setDob($year, $month, $day){
        if(checkdate($month, $day, $year)){     
            return $this->__set('dob',"$year-$month-$day");
        }else{
            return false;
        }
    }

}


?>