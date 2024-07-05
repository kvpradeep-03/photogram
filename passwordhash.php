<?php
$time = microtime(true);
    $options = [
        'cost' => 12, //depends on the cost how secured the hash ,how secured the algorithm and depends on this latency of validation can be changed.
    ];
    echo password_hash("pradeep",PASSWORD_BCRYPT,$options)."\n";    //todo check about the passwor_verify behavior of both default,bycrypt method (as gives same op by verifing)
    echo "\nTook ".(microtime(true)-$time)."sec";
    $hash1 = '$2y$10$HM6BfPduzTptFEw7HRm5gucIEkfFJ8P7vJEjQEF.OO69rwMw8Ydx2';
   if(password_verify("pradeep",$hash1)){
    echo "\npassword correct";
   }else{
    echo "\npassword wrong";
   }
?>