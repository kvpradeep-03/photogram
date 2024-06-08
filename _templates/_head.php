<head>
    <script src="/photogram/app/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Photogram</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="/photogram/app/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php
     //$_SERVER['php_self'] returns the current executing script in the document root.
     //basename slices the current file/folder in the given path . basename0("var/www/html/photogram/app/signup.php") --> signup.php .
     //basename("var/www/html/photogram/app/signup.php",".php") --> signup  (slices the '.php' as mentioned).
     //print_r(basename($_SERVER['PHP_SELF'],".php").'css'); 
    if(file_exists($_SERVER['DOCUMENT_ROOT']).'/photogram/app/css/'.basename($_SERVER['PHP_SELF'],".php").".css"){ //example `signup.css` sile exist means give thaat file else no.?> 
    <!--dynamic css link-->
    <link href="/photogram/app/css/<?=basename($_SERVER['PHP_SELF'],".php")?>.css" rel="stylesheet">
    <?}?>

</head>