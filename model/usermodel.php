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

    public function addToCart($params=array()){
        
        try{
            $this->connection->autocommit(FALSE);
            $productid = $this->escape_string($params[0]['productid']);
            $customerid = $this->escape_string($params[0]['customerid']);
            $quantity = $this->escape_string($params[0]['quantity']);
            $query = "SELECT * FROM tbl_customer_cart WHERE product_id = $productid AND customer_id = $customerid";
            $rows = $this->read($query);
            if($rows){
                $quantity = $rows[0]['quantity'] + $quantity;
                $query = "UPDATE `tbl_customer_cart` SET `quantity`=$quantity, `modified_at`=now(), `deleted_at` =NULL WHERE product_id = $productid AND customer_id = $customerid";
                $rows = $this->execute($query);
                if(!$rows) throw new Exception("Unable to add to cart");
                $this->connection->commit();
                return $rows;
            }
            $query = "INSERT INTO `tbl_customer_cart`(`product_id`, `customer_id`,`quantity`) VALUES ($productid,$customerid,$quantity)";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to add to cart");
            $this->connection->commit();
        return $rows;
        }catch(Exception $e){
            $this->connection->rollback();
            throw $e;
        }
        
    }

    public function viewCart($customerid){
        $customerid = $this->escape_string($customerid);
        $query = "SELECT * FROM view_customer_cart WHERE customer_id = $customerid";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("Cart is empty!");
        return $rows;
    }
    public function countCart($customerid){
        $customerid = $this->escape_string($customerid);
        $query = "SELECT count(*) as CartCount FROM view_customer_cart WHERE customer_id = $customerid";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("Cart is empty!");
        return $rows;
    }

    public function deleteCart($params=array()){
        try{
            $this->connection->autocommit(FALSE);
            $productid = $this->escape_string($params['productid']);
            $customerid = $this->escape_string($params['customerid']);
            $query = "UPDATE `tbl_customer_cart` SET deleted_at = now(), quantity = 0 WHERE product_id = $productid AND customer_id = $customerid";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to delete from cart");
            $this->connection->commit();
            return $rows;
        }catch(Exception $e){
            $this->connection->rollback();
            throw $e;
        }
    }
}

?>