<?php

include ('config/config.php');
class Database{

    //! Database Initialization Starts.

    public $host = HOST;
    public $user = USER;
    public $password = PASSWORD;
    public $database = DATABASE;

    public $link;
    public $error;

    //@ Database Initialization Ends.

    //! Database Connection Starts.

    public function __construct() {
     $this->dbConnect();
    }

    public function dbConnect(){
        $this->link = mysqli_connect($this->host,$this->user,$this->password,$this->database);

        if(!$this->link){
            $this->error = "Database connection failed.";
            return false;
        }
    }

    //@ Database Connection Ends.

    //! Insert Data Query Starts Here.

    public function insert($query){
        $result = mysqli_query($this->link,$query) or die ($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    //@ Insert Data Query  Ends Here.
    
    //! Select Data Query  Starts Here.

    public function select($query){
        $result = mysqli_query($this->link,$query) or die ($this->link->error.__LINE__);
        if(mysqli_num_rows($result) > 0){
            return $result;
        }else{
            return false;
        }
    }

    //@ Select Data Query  Ends Here.

    //! Update Data Query  Starts Here.

    public function update($query){
        $result = mysqli_query($this->link,$query) or die ($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    //@ Update Data Query  Ends Here.

    //! Delete Data Query  Starts Here.

    public function delete($query){
        $result = mysqli_query($this->link,$query) or die ($this->link->error.__LINE__);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    //@ Delete Data Query  Ends Here.
}

?>