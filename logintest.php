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

/*
[completed]
1. check if session_token in php Session is available
2. If yes, construct userSession and see if it successfull.
3. check if the session is valid one.
4. if valid print session vaidated
5. else print session invalidate and ask user to login

*/
if(Session::get('session_token')){   //retrives the previous session of user (session setted while logging in)  
    $username = Session::get('session_username');
    $userObj = new User($username); //if a session exists, use the session data to create the User object.
    UserSession::authorize(Session::get('session_token'));
    echo "Welcome back {$userObj->getUsername()}!<br>";
    $userObj->setBio("i love tech <br>");
    echo "Bio changed Succesfully ... `{$userObj->getbio()}`<br>";

}else{
    
    $result = User::login($user,$pass); //it again gets the user input for $user and $pass.
    if($result){ 
        $userObj = new User($result);     //if session doesn't exist it create the User object using the newly obtained username and update the session
        echo "Login success, {$userObj->getUsername()}<br>";
        Session::set('session_token',UserSession::authenticate($user,$pass));  
        Session::set('session_username',$userObj->getUsername());
    }else{
        echo "login failed, $user<br>"; //TODO: check the flow of login process

    }
}



?>