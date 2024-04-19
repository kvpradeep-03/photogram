<?php

function load_template($name){
 
    //__DIR__ provides the absolute path to the directory containing the current PHP script
    //Current dir is libs (htdocs/photogram/app/libs) => One step back (htdocs/photogram/app)->(Out of libs dir, Then it currently inside the app dir) => app 
    //[*changes the dir not folder*]
    include __DIR__."/../_templates/$name.php";
        
     
}
?>