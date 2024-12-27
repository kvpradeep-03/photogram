<?php
include 'libs/load.php';
$user = isset($_GET['user'])?$_GET['user'] : '';    //testuser
$pass = isset($_GET['pass'])?$_GET['pass'] : '';    //passuser
$result = null;
$result = User::login($user,$pass); //fetches the username.

if (isset($_GET['logout'])) {
    if (Session::isset("session_token")) {
        $Session = new UserSession(Session::get("session_token"));
        if ($Session->removeSession()) {
            echo "<h3> Pervious Session is removing from db </h3>";
        } else {
            echo "<h3>Pervious Session not removing from db </h3>";
        }
    }
    Session::destroy();
    die("Session destroyed, <a href='logintest.php'>Login Again</a>");
}


/*
[completed]
1. check if session_token in php Session is available
2. If yes, construct userSession and see if it successfull.
3. check if the session is valid one.
4. if valid print session vaidated
5. else print session invalidate and ask user to login

*/
if (Session::isset("session_token")) {
    if (UserSession::authorize(Session::get("session_token"))) {
        echo "<h1>Session Login, WELCOME $user </h1>";
    } else {
        Session::destroy();
        die("<h1>Invalid Session, <a href='logintest.php'>Login Again</a></h1>");
    }
} else {
    if (UserSession::authenticate($user, $pass)) {
        echo "<h1>New LOGIN Success,  WELCOME $user</h1>";
    } else echo "<h1>New Login Failed! $user</h1>";
}


?>