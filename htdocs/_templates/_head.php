<head>
    <script src="<?=get_config('base_path')?>assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Photogram</title>
    
    <!-- Bootstrap css CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!--hover.css CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.1/css/hover-min.css" integrity="sha512-SJw7jzjMYJhsEnN/BuxTWXkezA2cRanuB8TdCNMXFJjxG9ZGSKOX5P3j03H6kdMxalKHZ7vlBMB4CagFP/de0A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/style.css">
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Load Masonry -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
    <!-- Load imagesLoaded for proper layout adjustments -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js"></script>


    <?php
     //$_SERVER['php_self'] returns the current executing script in the document root.
     //basename slices the current file/folder in the given path . basename0("var/www/html/get_config('base_path')/signup.php") --> signup.php .
     //basename("var/www/html/get_config('base_path')/signup.php",".php") --> signup  (slices the '.php' as mentioned).
     //print_r(basename($_SERVER['PHP_SELF'],".php").'css'); 
    if(file_exists($_SERVER['DOCUMENT_ROOT']).get_config('base_path').'css/'.basename($_SERVER['PHP_SELF'],".php").".css"){ //example `signup.css` sile exist means give thaat file else no.?> 
    <!--dynamic css link-->
    <link href="<?=get_config('base_path')?>css/<?=basename($_SERVER['PHP_SELF'],".php")?>.css" rel="stylesheet">
    <?}?>

</head>