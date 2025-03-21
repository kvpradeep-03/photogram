<?php

include 'libs/load.php';
$upload_path = get_config('upload_path');
$fname = $_GET['name'];
$image_path = $upload_path . $fname;

// //to prevent directory traversal attack
// $image_path = str_replace('..', '', $image_path);

if(is_file($image_path)){
    header("Content-Type:".mime_content_type($image_path));
    header("Content-Length:".filesize($image_path));
    ob_clean();
    flush();   
    echo file_get_contents($image_path);
}

// include 'libs/load.php';
// $upload_path = get_config('upload_path');
// $fname = $_GET['name'];
// $image_path = $upload_path . $fname;

// if (!is_file($image_path)) {
//     header("HTTP/1.1 404 Not Found");
//     exit("File not found.");
// }

// // Get correct MIME type
// $finfo = finfo_open(FILEINFO_MIME_TYPE);
// $mime_type = finfo_file($finfo, $image_path);
// finfo_close($finfo);

// header("Content-Type: $mime_type");
// header("Content-Length: " . filesize($image_path));
// header("Cache-Control: public, max-age=86400");

// ob_clean();
// flush();
// readfile($image_path);
// exit;



?>