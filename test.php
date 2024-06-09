<pre>

<?php
include 'libs/load.php';
//The $_SERVER superglobal is an array containing information such as headers, paths, and script locations.
echo '$_SERVER<br>';
print_r($_SERVER);

//Contains data sent to the server as part of the URL query string.
//listens only URL's data
echo '$_GET<br>';
print_r($_GET);

//Contains data sent to the server via HTTP POST method.
//POST method in HTTP requests is typically sent in the request body.
//listen's both URL and BODY's data 
echo '$_POST<br>';
print_r($_POST);

//used to handle file uploads submitted via HTML forms 
//Contains information about uploaded files, including file name, type, size, and temporary location on the server.
echo '$_FILES<br>';
print_r($_FILES);

//Cookies are small pieces of data stored on the client's computer by the web browser.
//they are typically used for purposes such as session management, user authentication, and personalization.
//Cookies are sent to the server as part of the HTTP request headers.

//server side cookie setting

$cookie_name = 'User3';
$cookie_value = $_SERVER['REQUEST_URI'];

setcookie($cookie_name, $cookie_value, time() + (86400 * 50), "/"); //for 50 days

echo '$_COOKIE<br>';
print_r($_COOKIE);

//DB connection testing
if(signup("hello","hello23@","hello@gmail.com","467894300")){
    echo "success";
}else {
    echo "fail";
}




?>

</pre>