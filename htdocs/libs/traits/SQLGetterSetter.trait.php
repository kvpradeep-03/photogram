<?php
//SQLGetterSetter is used for fetching datas from DB dynamically at all tables.

 /**
  * trait in PHP is a mechanism that allows code reuse across multiple classes without using inheritance. 
 * To use this trait, the PHP Object's constructor should have
 * $id, $conn, $tabel variables set.
 * 
 * $id - The ID of the MySQL Table Row.
 * $conn - The MySQL Connection.
 * $table - The MySQL Table Name.
 */
  
trait SQLGetterSetter {
    
    //_call fun will be called if the called function(method) is not avalilabe in the class(like switchcase default in py)
    public function __call($name,$arguments){  
        //Removes non-alphanumeric characters from the substring starting at the 4th character of $name.
        //substr simply cuts a str into a represented index
        $property = preg_replace("/[^0-9a-zA-Z]/","",substr($name, 3)); 
        //Converts camelCase to snake_case by inserting an underscore before capital letters.
        $property = strtolower(preg_replace('/\B([A-Z])/','_$1',$property));    
        if(substr($name,0,3) == 'get'){ 
            return $this->_get_data($property);
        }elseif(substr($name,0,3) == 'set'){
            return $this->_set_data($property,$arguments[0]);      //$arguments[0]->first argument provided to the originally called method is being used as the value to set.
            
        }else{
            //in __call fun if we call any undeclared function in a class if simply omits the arguments which has passed, without throwing error.
            //so we are throwing exception for that un arguments passed for debugging purpose*.
            throw new Exception(__CLASS__."::_call() -> $name, function unavailable.");
        }
    }

    //this function  helps to retrive data from database
    public function _get_data($var){
        if(!$this->conn){
            $this->conn = Database::getConnection();
        }
        try{
            $sql = "SELECT `$var` FROM `$this->table` WHERE `id` = '$this->id'"; 
            $result = $this->conn->query($sql);
            if($result and $result->num_rows == 1){
                return $result->fetch_assoc()["$var"];      //retrieves the specified key value
                return null;
            }
        }catch(Exception $e){
            throw new Exception(__CLASS__."::_get_data() -> $var, data unavailable");
        }
    }

    //this function  helps to set data in the database
    public function _set_data($var, $data){
        if(!$this->conn){
            $this->conn = Database::getConnection();
        }
        try{
            $sql = "UPDATE `$this->table` SET `$var` = '$data' WHERE `id` = '$this->id'";  
            if($this->conn->query($sql)){
                return true; 
            }else{
                return false;
            }
        }catch(Exception $e){
            throw new Exception(__CLASS__."::_set_data() -> $var, data unavailable");
        }
    }

    public function delete() {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        try {
            // Fetch the image URL from the database
            $query = "SELECT `image_uri` FROM `$this->table` WHERE `id` = $this->id";
            $result = $this->conn->query($query);
    
            if ($result && $result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $image_uri = $row['image_uri'];  // Get the actual image path from DB
                
                // Construct the absolute file path
                $image_path = __DIR__ . "/../../../../../photogram_uploads/" . basename($image_uri);
    
                // Check if file exists before attempting to delete
                if (file_exists($image_path)) {
                    unlink($image_path);
                
                }
            } else {
                throw new Exception(__CLASS__ . "::delete, image url unavailable");
            }
    
            // Proceed to delete the database entry
            $sql = "DELETE FROM `$this->table` WHERE `id` = $this->id";
            if ($this->conn->query($sql)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            throw new Exception(__CLASS__ . "::delete, data unavailable: " . $e->getMessage());
        }
    }
    
}
?>