<?php
//include mannually since it didn't works at lib includes.
include_once __DIR__ . "/../traits/SQLGetterSetter.trait.php";

class Post{
    
    use SQLGetterSetter;
    public $id;
    private $conn;
    public $table;
    public static function registerPost($text, $image_temp){    //(post_text,uploaded image wiil be placed into ~/photogram_uploads)
        if(is_file($image_temp) and exif_imagetype($image_temp) != false){       //determine the type of image by scanning the first few bytes of the file
            $author = Session::getUser()->getUsername();
            $image_name = md5($author.time()). image_type_to_extension(exif_imagetype($image_temp)); //gets extention type of the image.
            $image_path = get_config('upload_path'). $image_name;
            if(move_uploaded_file($image_temp, $image_path)){ 
                $image_uri = "/files/$image_name";
                $insert_command = "INSERT INTO `posts` (`post_text`, `multiple_images`, `image_uri`, `like_count`, `uploaded_time`, `owner`)
                VALUES ('$text', 0, '$image_uri', 0, now(), '$author')";
                $db = Database::getConnection();
                if($db->query($insert_command)){
                    $id = mysqli_insert_id($db);        //returns the id of post DB.
                    return new Post($id);
                }else{
                    return false;
                }

            }
        }else{
            throw new Exception("Image not uploaded");
        }
    }

    public function __construct($id){
        $this->id = $id;
        $this->conn = Database::getConnection();
        $this->table = 'posts';
        
    }

}
?>