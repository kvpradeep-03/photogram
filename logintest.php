<?php
include 'libs/load.php';
$user = isset($_GET['user'])?$_GET['user'] : '';    //testuser
$pass = isset($_GET['pass'])?$_GET['pass'] : '';    //passuser
$result = null;
$result = User::login($user,$pass); //fetches the username.

if(isset($_GET['logout'])){
    Session::destroy();
    die("Session destroyed, <a href='logintest.php'>Login Again</a><br>");
}

if(Session::get('is_logedin')){   //retrives the previous session of user (session setted while logging in)  
    $username = Session::get('session_username');
    $userObj = new User($username); //if a session exists, use the session data to create the User object.
    echo "Welcome back {$userObj->getusername()} !<br>";
    $userObj->setBio("i love tech ");
    echo "Bio changed Succesfully ... `{$userObj->getbio()}`<br>";

}else{
    echo "No Session found, trying to login now...<br>";
    $result = User::login($user,$pass); //it again gets the user input for $user and $pass.
    if($result){  
        $userObj = new User($user);     //if session doesn't exist it create the User object using the newly obtained username and update the session
        echo "Login success, $userObj->getUsername";
        Session::set('is_logedin',true);  
        Session::set('session_username',$result);
    }else{
        echo "login failed, $user<br>";

    }
}



?>