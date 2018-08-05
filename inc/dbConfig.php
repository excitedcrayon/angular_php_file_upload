<?php
/*
dbConfig script for connecting and interacting with MySQL DB
*/
require_once('config.php');
class dbConfig{
    public function __construct($host, $username, $password, $name){
        $this->dbHost = $host;
        $this->dbUsername = $username;
        $this->dbPassword = $password;
        $this->dbName = $name;
    }

    public function connect(){
        //$this->dbHost = $dbHost;
        $this->con = mysqli_connect($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
        if(!$this->con){
            #debug purposes code
            //echo 'Could not establish connection to database: ' . $this->dbName . '. SQL Error: ' . mysqli_error($this->con) .'<br>';
        }else{
            #debug purposes code
            //echo '<script>console.log("Connected to database!");</script>';
        }
        return $this->con;
    }

    public function escapeString($string){
        return mysqli_real_escape_string($this->con, $string);
    }

    public function query($sql){
      return mysqli_query($this->con, $sql);
    }

    public function getResult($sql){
        return mysqli_query($this->con, $sql);
    }

    public function fetchAssoc($result){
        return mysqli_fetch_assoc($result);
    }

    public function getError(){
        return mysqli_error($this->con);
    }

    public function getNumRows($result){
        return mysqli_num_rows($result);
    }

    public function freeResult($result){
        return mysqli_free_result($result);
    }

    public function closeConnection(){
        return mysqli_close($this->con);
    }
}
?>
