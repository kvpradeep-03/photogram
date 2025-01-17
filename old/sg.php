<pre>
<?php
include_once 'libs/load.php';

Session::start();    //session willl start is an builin function 

echo("_SESSION<br>");
print_r($_SESSION);
echo("_SERVER<br>");
print_r($_SERVER);

if(isset($_GET['clear'])){
    Session::unset();
    echo "Clearing...<br>";
}

if((Session::isset('a'))){  //calls isset($key) function in Session.class.php
    print "Session already exists... Value: ".Session::get('a')."<br>"; //get($key,$default = false)
}else{
    Session::set('a',time());   //calls set($key,$value) ->sets key(a) and value(time)<-  function in Session.class.php
    print "Creating a new session...  Value: ".Session::get('a')."<br>";
}

if(isset($_GET['destroy'])){
    Session::destroy();
    echo "Destroying...<br>";
}


?>
</pre>