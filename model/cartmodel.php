<?php
include_once('../../db/connection.php');
interface ICart{
    public function viewCart($params);
    public function addToCart($params);
    public function updateCart($params);
    public function deleteCart($params);
}
class Cart extends Database implements ICart{
    public function __construct(){
        parent::__construct();
    }
    public function viewCart($params){
        try{
            $customerid = $this->escape_string($params);
            $query = "SELECT * FROM `view_customer_cart` WHERE `customer_id` = '$customerid'";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to get cart");
            return $rows;
        }catch(Exception $e){
            throw $e;
        }
    }
    public function addToCart($params){
        try{
            $customerid = $this->escape_string($params['customerid']);
            $productid = $this->escape_string($params['productid']);
            $quantity = $this->escape_string($params['quantity']);
            $query = "INSERT INTO `tbl_customer_cart`(`customer_id`, `product_id`, `quantity`) VALUES ('$customerid','$productid','$quantity')";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to add to cart");
            return $rows;
        }catch(Exception $e){
            throw $e;
        }
    }
    public function updateCart($params){
        try{
            $customerid = $this->escape_string($params['customerid']);
            $productid = $this->escape_string($params['productid']);
            $quantity = $this->escape_string($params['quantity']);
            $query = "UPDATE `tbl_customer_cart` SET `quantity`='$quantity' WHERE `customer_id` = '$customerid' AND `product_id` = '$productid'";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to update cart");
            return $rows;
        }catch(Exception $e){
            throw $e;
        }
    }
    public function deleteCart($params){
        try{
            $customerid = $this->escape_string($params['customerid']);
            $productid = $this->escape_string($params['productid']);
            $query = "UPDATE `tbl_customer_cart` SET `deleted_at` = NOW() WHERE `customer_id` = '$customerid' AND `product_id` = '$productid'";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to delete cart");
            return $rows;
        }catch(Exception $e){
            throw $e;
        }
    }
}

?>