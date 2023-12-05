<?php
include_once('../../db/connection.php');
/*
@class userModel only scopes customer not admin
*/

class UserModel extends Database{

 
    public function __construct(){
        parent::__construct();
    }

    public function selectUser($username){
        $username = $this->escape_string($username);
        $query = "SELECT * FROM view_user_customer WHERE username= '$username'";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("Invalid Username or password");
        return $rows;
    }
}

?>