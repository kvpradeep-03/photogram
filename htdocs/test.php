<pre>

<?php
include 'libs/load.php';
/*
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


if(signup('testuser', 'testpass', 'test@gmail.com', '1234567890', 0, 1)){
    echo "insert success\n";
}else {
    echo "insert fail\n";
}

//working of try exception catch
$user_name = 'pradeep';
$check = false;
try{
    if($user_name == true){
        $check = false;
        echo "data found!\n";  
    }else{
        $check = false;
        throw new Exception("data not found!\n");
    }
} catch(Exception $e){ // inside bracket imbuile function $e -> stores exception message
    echo "ACTION REQUIRED: " . $e->getMessage(); // getMessage() -> fetches $e (raised exception)
}
function test_signup($user,$pass,$email,$phone){
    $servername ="mysql.selfmade.ninja";
    $username = "pradeep_";
    $password = "prad2003";
    $dbname = "pradeep__test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO `data` (`username`, `password`, `email`, `phone`)
    VALUES ('$user', '$pass', '$email', '$phone')";

    if($conn->multi_query($sql) === true){
        $last = $conn->insert_id;
        echo "multi qurey inserted id in   ----> ".$last;
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
 
 test_signup("multi1","multi1pass","multi1@vgw.com","326437432");
 test_signup("multi2","multi1pass","multi2@vgw.com","326437432");
 test_signup("multi3","multi1pass","multi3@vgw.com","326437432");

 //constructing the objects
 // -were it give an instance(clone of original class mic) to the $mic1 and $mic2
*/
// $mic1 = new Mic();
// $mic2 = new Mic();

// Setting properties for $mic1
// $mic1->brand = "Roda";
// $mic1->usb_port = "typeb";

// Setting properties for $mic2
// $mic2->brand = "HyperX";
// $mic2->usb_port = "typec";


// Set the initial light property to "white"
// $mic1->light = "white"; 

// Call the setLight method to change the light color to "blue
// $mic1->setLight("blue");

// $mic2->price ="129"; //actual price
// $mic2->setPrice("109"); //coupen applied

// $mic1->color = "Mercury blue";
// $mic1->applyColor("Titaniam grey");

// $mic1->getVoltage(array(0.1,2,33,42),'hello',$varient = new Mic());     //goes to __call function
/*
$conn = Database::getconnection();
$conn = Database::getconnection();

class car {
	public $color;
    public static $year;
    protected static $type;
    
    public function setColor($color){
    	$this->color = $color;
    }
    public function getColor(){
      return 'Car color is '.$this->color."\n";
    }
    public static function setYear($year){
    	self::$year = $year;
    }
    public static function getYear(){
        return 'Car year is '.self::$year."\n";
    }

    public static function setType($type){
        self::$type = $type;
    }
    public function getType($type){
        return $this->type;
    }
}

class registed extends car {
    public $no;
    protected $rating;

    public function __construct($year,$no){
        self::$year = $year;
        $this->no = $no;
        echo "Car manf YEAR: " .self::$year. " and REG.NO: ".$this->no;
 
    }

    public function setRating($rating){
        $this->rating = $rating;
    }
    public function getRating(){
        return $this->rating;
    }

    public function getPrivateinfo(){
        echo "Car's TYPE: ".self::$type. " and Rating: ".$this->rating;
    }
    
 
}
interface slot{
    public function slot();
}
class carsBikes implements slot{
    public function slot(){
        echo "park your vehicle in BAY-10338\n";
    }
}
class trucks implements slot{
    public function slot(){
        echo "park your vehicle in BAY-20637\n";
    }
}
$car1 = new car();
$car1->setColor('blue');
echo $car1->getColor();
$car1->setYear('2023');
$car1->setType('Crossover');

echo $car1->getYear();
$reg = new registed(2003,'TN12R0983');
$reg->setRating(4.5);
$reg->getPrivateinfo();*/

echo Session::getUser()->getEmail();
$img_tmp = $_FILES['post_image']['tmp_name'];    // tmp_name-> Temporary file path ,php stores the file in a temporary location until it is moved to the desired location.
$text = $_POST['post_text'];

Post::registerPost($text, $img_tmp);

echo("_FILES<br>");
print_r($_FILES);

?>
</pre>