<?php
File_put_contents("/home/kvpradeep60/htdocs/photogram/cornlogs.txt", "Hello user! @ ".time()."\n", FILE_APPEND);

session_id('d6l1frrc98dovh2rmuueevnmue');
session_start();

print($_SESSION['web']);
?>