<?php
//https:domain/api/post/like

${basename(__FILE__,'.php')} = function(){
    if($this->isAuthenticated() and $this->paramsExist('id')){  //paramsExist checks is any param passed on post.
        $p = new Post($this->_request['id']);
        $l = new Like($p);
        $l->toggleLike();
        $this->respone($this->json([
            'message'=>'Liked',
            'Liked'=>$l->isLiked(),
        ]),200);
    }else{
        $this->response($this->json([
            'message'=>'bad request'
        ]), 400);
    }
}; 

?>