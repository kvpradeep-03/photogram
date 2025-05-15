<?php

  ${basename(__FILE__, '.php')} = function () {
    if ($this->paramsExists(['username','password'])) {
        $user = $this->_request['username'];
        $pass = $this->_request['password'];
        $token = UserSession::authenticate($user, $pass);

        if($token){
            $this->response($this->json([
                'message'=>"Authenticated.",
                'token'=>$token,
            ]), 200); 
        }else{
            $this->response($this->json([
            'message'=>"Unauthorize.",
            'token'=>$token,
            ]), 401); 
        }
        

    } else {
        $this->response($this->json([
            'message'=>"bad request"
        ]), 400);
    }
};