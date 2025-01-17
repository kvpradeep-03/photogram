<?php
include 'libs/load.php';

if(Session::isAuthenticated()){
    header("Location: /");
    die(); // exits from the current block.
}

Session::renderPage();


?>
