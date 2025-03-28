<?php

error_reporting(E_ALL ^ E_DEPRECATED);
require_once 'REST.class.php';
class API extends REST
{
    public $data = "";
    private $current_call;

    public function __construct()
    {
        parent::__construct();                  // Init parent contructor
    }

    /*
    * Public method for access api.
    * This method dynmically call the method based on the query string
    *
    */
    public function processApi()
    {
        $request = strtolower(trim($_REQUEST['rquest'])); //TODO: Check for IDOR here.
        $func = basename($request);
        if (!isset($_GET['namespace']) and (int)method_exists($this, $func) > 0) {
            $this->$func();
        } else {
            if (isset($_GET['namespace'])) {
                $dir = $_SERVER['DOCUMENT_ROOT'].'/libs/includes/api/'.$_GET['namespace'];
                $file = $dir.'/'.$request.'.php';
                if (file_exists($file)) {
                    include $file;
                    $this->current_call = Closure::bind(${$func}, $this, get_class());  //binding the request function to this API class
                    $this->$func(); //dynamically calling the function
                } else {
                    $this->response($this->json(['error'=>'method_not_found']), 404);
                }
            } else {
                //we can even process functions without namespace here.
                $this->response($this->json(['error'=>'method_not_found']), 404);
            }
        }
    }

    public function isAuthenticated()
    {
        return Session::isAuthenticated();
    }

    /**
     * @param $param Http Parameters
     * Checks if all supplied parameters exists
     */
    public function paramsExists($parms = array())
    {
        $exists = true;
        foreach ($parms as $param) {
            if (!array_key_exists($param, $this->_request)) {
                $exists = false;
            }
        }
        return $exists;
    }

    public function isAuthenticatedFor(User $user)
    {
        return Session::getUser()->getEmail() == $user->getEmail();
    }

    public function getUsername()
    {
        return Session::getUser()->getUsername();
    }

    public function die($e)
    {
        $data = [
            "error" => $e->getMessage(),
            "type" => "death"
        ];
        $response_code = 400;
        if ($e->getMessage() == "Expired token" || $e->getMessage() == "Unauthorized") {
            $response_code = 403;
        }

        if ($e->getMessage() == "Not found") {
            $response_code = 404;
        }
        $data = $this->json($data);
        $this->response($data, $response_code);
    }

    public function __call($method, $args)
    {
        if (is_callable($this->current_call)) {
            return call_user_func_array($this->current_call, $args);
        } else {
            $error = ['error'=>'methood_not_callable', 'method'=>$method];
            $this->response($this->json($error), 404);
        }
    }

    /*************API SPACE START*******************/

    private function test()
    {
        $data = $this->json(getallheaders());
        $this->response($data, 200);
    }

    private function gen_hash()
    {
        $st = microtime(true);
        if (isset($this->_request['pass'])) {
            $cost = (int)$this->_request['cost'];
            $options = [
                "cost" => $cost
            ];
            $hash = password_hash($this->_request['pass'], PASSWORD_BCRYPT, $options);
            $data = [
                "hash" => $hash,
                "info" => password_get_info($hash),
                "val" => $this->_request['pass'],
                "verified" => password_verify($this->_request['pass'], $hash),
                "time_in_ms" => microtime(true) - $st
            ];
            $data = $this->json($data);
            $this->response($data, 200);
        }
    }

    private function verify_hash()
    {
        if (isset($this->_request['pass']) and isset($this->_request['hash'])) {
            $hash = $this->_request['hash'];
            $data = [
                "hash" => $hash,
                "info" => password_get_info($hash),
                "val" => $this->_request['pass'],
                "verified" => password_verify($this->_request['pass'], $hash),
            ];
            $data = $this->json($data);
            $this->response($data, 200);
        }
    }
    /*************API SPACE END*********************/

    /*
    Encode array into JSON
    */
    private function json($data)
    {
        if (is_array($data)) {
            return json_encode($data, JSON_PRETTY_PRINT);
        } else {
            return "{}";
        }
    }
}

function startsWith($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}
