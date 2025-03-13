<?php

include 'libs/load.php';
$upload_path = get_config('upload_path');
$fname = $_GET['name'];
$image_path = $upload_path . $fname;
if(is_file($image_path)){
    header("Content-Type:".mime_content_type($image_path));
    header("Content-Length:".filesize($image_path));
    ob_clean();
    flush();   
    echo file_get_contents($image_path);
}




?>