<?php
//Session class used to manipulate user session by setting,getting,validating.
class Session{

    public static $user = null;     //setted by Usersession:authorize(); which has new user instance.
    public static $usersession = null;

    public static function start(){
        session_start();    //starts the session.
    }

    public static function unset(){
        session_unset();    //unsets the session.
    }

    public static function destroy(){
        session_destroy();  //destroys the current session.
        /*
        //TODO: If UserSession is active set it as inactive.
        */
    }

    public static function set($key,$value){    
        $_SESSION[$key] = $value;   //[$key]: This accesses the specific session variable by the key provided. $value;: This assigns the value to the session variable.
    }

    public static function delete($key){
        unset($_SESSION[$key]); //delets the session key.
    }

    public static function isset($key){
        return isset($_SESSION[$key]);  //checks whether the session key is exist or not.
    }

    public static function getUserSession(){
        return Session::get('user_session');    //returns entire usersession stored by WebAPI via authorize block of UserSession
    }

    public static function get($key,$default = false){
        if(Session::isset($key)){
            return $_SESSION[$key];  //returns the value.
        }else{
            return $default;
        }
    }

    public static function getUser(){
        return Session::$user;  //returns the new user instance 
    }

    //function for initial loading of all templates.
    public static function loadTemplate($name){
 
        $script = $_SERVER['DOCUMENT_ROOT'].get_config('base_path')."/_templates/$name.php";
        if(is_file($script)){
            include $script;
        }else{
            Session::loadTemplate('_error');
        }
        
    }

    public static function renderPage(){

        //loads default head,header,footer except body which changes dynamically.
        Session::loadTemplate('_master');
    }

    public static function currentScript(){
        //returns the current executing script in the document root. & removes the '.php' extension.
        return basename($_SERVER['SCRIPT_NAME'], '.php'); 
    }

    public static function isAuthenticated(){
        //Session::getUserSession() 'user_session' stored while login via webAPI from has objs of session data in that accessing isvalid()
        if(is_object( Session::getUserSession())){
            return Session::getUserSession()->isValid();  
        }
        return false;  
    }

    public static function ensureLogin(){
        if(!Session::isAuthenticated()){
            header("Location: /login.php");
            die();
        }
    }
}

?>