<?php
require_once ("DBConnect.php");
session_start();
class MainController extends  DatabaseConnect{
    public function redirectTo($location = NULL){
        if($location!=NULL){
            header("Location:{$location}");
            exit;
        }
    }
    public function verifyHash($password,$hashedPassword){
        return crypt($password, $hashedPassword) == $hashedPassword;
    }
    public function sessionCheck(){
        if(isset($_SESSION['userId'])){
            return true;
        } else {
            return false;
        }
    }
    public function userNotLogin($location){
        if($this->sessionCheck() == false) {
            $this->redirectTo($location);
        }
    }
    public function serLogin($location){
        if($this->sessionCheck() == true){
            $this->redirectTo($location);
        }
    }
    public function passwordHash($password){
        if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
            $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
            return crypt($password, $salt);
        }
    }
    public function rowCount($run){
        $query = $this->run($run);
        return $this->rows($query);
    }
   
    public function select($tbl, $where, $action, $field){
        $sql = "SELECT `$field` FROM `$tbl` WHERE `$where`='$action'";
        $run = $this->run($sql);
        if($this->rows($run) == 1){
            while ($row = $this->fetch($run)){
                return $row[$field];
            }
        }else{
            return false;
        }
    }
   

}

$main = new MainController;

