<?php

class Session{

    public static function start(){
        session_start();    //starts the session.
    }

    public static function unset(){
        session_unset();    //unsets the session.
    }

    public static function destroy(){
        session_destroy();  //destroys the current session.
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

    public static function get($key,$default = false){
        if(Session::isset($key)){
            return $_SESSION[$key];  //returns the key.
        }else{
            return $default;
        }
    }
}

?>