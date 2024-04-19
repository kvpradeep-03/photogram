<?php

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
?>