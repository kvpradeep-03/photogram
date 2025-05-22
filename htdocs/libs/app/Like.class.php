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
        $this->id = md5($this->user_id . "-" . $this->post_id);
        $this->conn = Database::getConnection();
        $this->post = 'posts';
        $this->data = null;

        $query = "SELECT * FROM `likes` WHERE `id` = '$this->id'";
        $result = $this->conn->query($query);
        if ($result->num_rows == 1) {
            // Like entry already exists, increase like count if not already liked
            $row = $result->fetch_assoc();
            if ($result) {
                // // Increase like_count in posts table
                // $update_post = "UPDATE `posts` SET `like_count` = `like_count` + 1 WHERE `id` = '{$this->post_id}'";
                // $this->conn->query($update_post);
            }
        } else {
            // Insert new like entry and increase like count
            $query_insert = "INSERT INTO `likes` (`id`, `user_id`, `post_id`, `like`, `timestamp`)
                VALUES ('$this->id', '$this->user_id', '$this->post_id', 1, now())";
            $result_insert = $this->conn->query($query_insert);
            if (!$result_insert) {
                throw new Exception("Unable to create like entry");
            }
            // Increase like_count in posts table
            $update_post = "UPDATE `posts` SET `like_count` = `like_count` + 1 WHERE `id` = '{$this->post_id}'";
            $this->conn->query($update_post);
        }
    }

    public function toggleLike(){
        $liked = $this->getLike();
        if(boolval($liked) == true){
            // Unlike: set like to 0 and decrease like_count
            $this->setLike(0);
            $update_post = "UPDATE `posts` SET `like_count` = GREATEST(`like_count` - 1, 0) WHERE `id` = '{$this->post_id}'";
            $this->conn->query($update_post);
        }else{
            // Like: set like to 1 and increase like_count
            $this->setLike(1);
            $update_post = "UPDATE `posts` SET `like_count` = `like_count` + 1 WHERE `id` = '{$this->post_id}'";
            $this->conn->query($update_post);
        }
    }

    public function isLiked(){
        return boolval($this->getLike());
    }
}
?>