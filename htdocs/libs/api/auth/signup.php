<?php

  ${basename(__FILE__, '.php')} = function () {
    if ($this->paramsExists(['username','password','email','phone'])) {
        $username = $this->_request['username'];
        $password = $this->_request['password'];
        $email = $this->_request['email'];
        $phone = $this->_request['phone'];
        $result = User::signup($username,$password,$email,$phone);

        if($result){
            $this->response($this->json([
                'message'=>"Successfully Signed Up.",
                'result'=>$result,
            ]), 200); 
        }else{
            $this->response($this->json([
            'message'=>"Unauthorize.",
            'result'=>$result,
            ]), 401); 
        }
        

    } else {
        $this->response($this->json([
            'message'=>"bad request"
        ]), 400);
    }
};