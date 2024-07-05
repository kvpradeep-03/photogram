<?php
include 'libs/load.php';

$user = isset($_GET['user'])?$_GET['user'] : '';
$pass = isset($_GET['pass'])?$_GET['pass'] : '';
$result = null;
$result = User::login($user,$pass); //fetches the row data here.

if(isset($_GET['logout'])){
    Session::destroy();
    die("Session destroyed, <a href='logintest.php'>Login Again</a><br>");
}
if(Session::get('session_user')){//if true it store the [$result->($user,$pass)] to the $userdata var.
    $userdata = Session::get('session_user');
    print("Welcome back, $userdata[username]!<br>");
    //$result = $userdata;
}else{
    echo "No Session found, trying to login now...<br>";
    $result = User::login($user,$pass); //it again gets the user input for $user and $pass.
}
if($result){  
    echo "login success $result[username] :)<br>";
    //Session::set('is_logedin',true);    //sets login sessionid only if true
    Session::set('session_user',$result);   //setting session_user as key variable and $result as user,pass,email,..(data in the form of associative array).
    
}else{
    echo "login failed<br>";
    
    //echo $pass;
}
?>