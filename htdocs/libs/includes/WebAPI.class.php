<?php
//WebApi serves as API handeler(fetches the conf files) for a site and initiate sessions 
class WebAPI {
    
    public function __construct(){

        global $__site_config; 
        $__site_config_path = __DIR__ . '/../../../project/photogramconfig.json';
        $__site_config = file_get_contents($__site_config_path);
        
        Database::getConnection();
        
    }

    public function initiateSession(){
        
        Session::start();
        if(Session::isset("session_token")){
            try{
                $session = UserSession::authorize(Session::get('session_token'));
                Session::set('user_session', $session);     //stores entire user session
                               
            }catch(Exception $e){

            }
        }

        
    }
}




?>