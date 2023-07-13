<?php

class DatabaseConnect{
    /* database vailables */
    private $host = 'localhost';
    private $username = '';
    private $password = '';
    private $database = '';
    private $connection;

    /* contruct function will automatic load the database connection*/
    public function __construct(){
        $this->Connect();
    }
    /*connect funtion */
    public function Connect(){
        $this->connection = @mysqli_connect($this->host,$this->username,$this->password,$this->database);
        if(!$this->connection) {
            echo '<h3>Connection to Website/Server Failed</h3>'.mysqli_connect_errno();
            die;
        } else {
            return true;
        }
    }
    public function require_page($path=""){
        if($path != ""){
            require_once($path);
        }
    }
    public function clean($str) {
        $str = @trim($str);
        $str = stripslashes($str);

        return $this->escape($str);
    }
    public function run($run){
        $result = mysqli_query($this->connection,$run);
        return $result;
    }
    public function escape($string){
        $escape_string = mysqli_real_escape_string($this->connection,$string);
        return $escape_string;
    }

    /* DataBase neutral Function */

    public function fetch($run){
        return mysqli_fetch_array($run);
    }

    public function assoc($run){
        return mysqli_fetch_assoc($run);
    }

    public function rows($qry){
        return mysqli_num_rows($qry);
    }

    public function insert_id(){
        return mysqli_insert_id($this->connection);
    }

    public function affected_rows(){
        return mysqli_affected_rows($this->connection);
    }

    /* DataBase neutral Function ends here */
}
