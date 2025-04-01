<?php
include_once __DIR__ . "/../traits/SQLGetterSetter.trait.php";

class Like{
    use SQLGetterSetter;
    public $user_id;
    public $post_id;
    public $post;
    public $id;
    private $conn;
    public $table = 'likes';
    public $data;


    public function __construct(Post $post){
        $this->user_id = Session::getUser()->getID();
        $this->post_id = $post->getID();
        $this->id = md5(Session::getUser()->getID()."-".$post->getID());
        $this->conn = Database::getConnection();
        $this->post = 'posts';
        $this->data = null;

        $query = "SELECT * FROM `$this->table` WHERE `id` = '$this->id'";
        $result = $this->conn->query($query);
        if($result->num_rows == 1){
            //insert like if no entry
        }else{
            $query_insert = "INSERT INTO `$this->tables` (`id`, `user_id`, `post_id`, `like`, `timestamp`)
                             VALUES ('$this->id', '$this->user_id', '$this->post_id', '0', now());";
            $result = $this->conn->query($query_insert);
            if($result){
                if(!$this->conn->query($query)){
                    throw new Exception("Unable to create Like entry");
                }

            }else{

            }
        }

    }

    public function toggleLike(){
        $liked = $this->getLike();
        if(boolval($liked) == true){ //converts anything to boolean
            $this->setLike(0);        
        }else{
            $this->setLike(1);
        }
    }

    public function isLiked(){
        return boolval($this->getLike());
    }
}




?>