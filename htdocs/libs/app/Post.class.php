<?php
//include mannually since it didn't works at lib includes.
include_once __DIR__ . "/../traits/SQLGetterSetter.trait.php";

class Post{
    
    use SQLGetterSetter;
    public $id;
    private $conn;
    public $table;
    public static function registerPost($text, $image_temp){    //(post_text,uploaded image wiil be placed into ~/photogram_uploads)
        if(isset($_FILES['post_image'])){       //$_FILES magic function stores uploaded images.
            $author = Session::getUser()->getUsername();
            $image_name = md5($author.time()). ".jpg";
            $image_path = get_config('upload_path'). $image_name;
            if(move_uploaded_file($image_temp, $image_path)){ 
                $insert_command = "INSERT INTO `posts` (`post_text`, `image_uri`, `like_count`, `uploaded_time`, `owner`)
                VALUES (' astronaut', 'https://cdn3.pixelcut.app/7/20/uncrop_hero_bdf08a8ca6.jpg', '21', now(), 'racer')";
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