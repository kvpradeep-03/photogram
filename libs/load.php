<?php

//php error display

// Enable error reporting for debugging purposes
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);


//included class files
//include_once just includes a file only at once and store it in a memory,it doesn't includes furthermore even if we reload this page
include_once 'includes/Mic.class.php';
include_once 'includes/Database.class.php';
include_once 'includes/User.class.php';




//function for initial loading of all templates.
function load_template($name){
 
    //__DIR__ provides the absolute path to the directory containing the current PHP script, tightly coupled with current working directory
    //Current dir is libs (htdocs/photogram/app/libs) => One step back (htdocs/photogram/app)->(Out of libs dir, Then it currently inside the app dir) => app 
    //[*changes the dir not folder*]
    //include __DIR__."/../_templates/$name.php";
    
    //superglobal is an array containing information such as headers, paths, and script locations, tightly coupled with server envirnoment and request details. 
    //these superglobal are responsible for transferring information(input request) from apache to php.
    //$_SERVER[DOCUMENT_ROOT] => /var/www/html 
    include $_SERVER['DOCUMENT_ROOT']."/photogram/app/_templates/$name.php";
    
     
}

//function for user validation.
function validate_credential($username, $password){  
    if($username == "kvpradeep60@gmail.com" and $password == "password"){
        return true;
    }
    else{
        return false;
    }

}




?>


