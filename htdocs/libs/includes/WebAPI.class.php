<?php

class WebAPI {
    
    public function __construct(){
       
        // if(php_sapi_name() == 'cli'){   //to run services in backen by detching the process & run the process via cmd like multithreads.
        //     //sets global var
        //     global $__site_config; 

        //     // Determine the full path to 'photogramconfig.json'. 
        //     // If the document root is a symbolic link, resolve its actual path.
        //     // Otherwise, use the document root directly and append '/photogramconfig.json'.
        //     $__site_config_path = "/home/kvpradeep60/htdocs/photogram/project/photogramconfig.json";
        //     // Read the content of 'photogramconfig.json' from the resolved path 
        //     // and store it in the $__site_config variable.
        //     $__site_config = file_get_contents($__site_config_path);
        //     print($__site_config);
        // }elseif(php_sapi_name() == 'apache2handler'){   //as usual run the services in browser.
        //     global $__site_config; 
        //     $__site_config_path = dirname(is_link($_SERVER['DOCUMENT_ROOT']) ? readlink($_SERVER['DOCUMENT_ROOT']) : $_SERVER['DOCUMENT_ROOT']) . '/project/photogramconfig.json';
        //     $__site_config = file_get_contents($__site_config_path);
        // }

        global $__site_config; 
        $__site_config_path = __DIR__ . '/../../../project/photogramconfig.json';
        $__site_config = file_get_contents($__site_config_path);
        
        Database::getConnection();
        
    }

    public function initiateSession(){
        Session::start();
        
    }
}




?>