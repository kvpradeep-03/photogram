<?php

// https://domain/api/posts/delete
${basename(__FILE__, '.php')} = function () {
    if ($this->isAuthenticated() and $this->paramsExists('id')) {
        $p = new Post($this->_request['id']);
        $this->response($this->json([
            'message'=>$p->delete()
        ]), 200);
    } else {
        $this->response($this->json([
            'message'=>"bad request"
        ]), 400);
    }
};
