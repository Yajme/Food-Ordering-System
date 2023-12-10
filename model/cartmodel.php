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
    /**
     * Retrieves the cart items for a specific customer.
     *
     * @param mixed $params The customer ID.
     * @return array The cart items.
     * @throws Exception If unable to get the cart.
     */
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
    /**
     * Adds a product to the customer's cart.
     *
     * @param array $params The parameters containing customer ID, product ID, and quantity.
     * @return int The number of rows affected by the insert query.
     * @throws Exception If unable to add the product to the cart.
     */
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
    /**
     * Updates the quantity of a product in the customer's cart.
     *
     * @param array $params The parameters containing the customer ID, product ID, and quantity.
     * @return int The number of rows affected by the update query.
     * @throws Exception If unable to update the cart.
     */
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
    /**
     * Deletes a cart item for a specific customer and product.
     *
     * @param array $params The parameters containing the customer ID and product ID.
     * @return int The number of rows affected by the deletion.
     * @throws Exception If unable to delete the cart item.
     */
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