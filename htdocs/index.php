<?php
include 'libs/load.php';

/**
 * Outside the htdocs files are like routers, which routes the request file into _templates folder.
 * 
 * By Session::renderPage() it retirects to _templates/_master file, it acts like master to photogram site (MVC), 
 * what to show b/w loged/unlogged users and according to loadTemplate at _master file the resuested file's templates are fetched.
 * 
 * WebAPI initiates session as well as authorizes before login/signup.
 * 
 * UserSession::authenticate() creates $session var and stores new UserSession() instance which stores the entire
 * instance objects as Sessions in the name  of 'user_session' done at WebAPI class.
 * and creates new User instance and stored to Session::$getUser()
 * 
 * The User instance are can be used to fetch user infos.
 * 
 */


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
    header("Location: /");
    die();
}else {
    Session::renderPage();
}



?>
