<?php
//https:domain/api/post/like

${basename(__FILE__,'.php')} = function(){
    if($this->isAuthenticated() and $this->paramsExist('id')){  //paramsExist checks is any param passed on post.
        $this->respone($this->json([
            'message'=>'success',
        ]),200);
    }else{
        $this->response($this->json([
            'message'=>'bad request'
        ]), 400);
    }
}; 

?>