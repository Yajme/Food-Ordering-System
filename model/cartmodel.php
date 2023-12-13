<?php
include_once('../../db/connection.php');
interface ICart{
    public function viewCart($params);
    public function addToCart($params);
    public function updateCart($params);
    public function deleteCart($params);
    public function countCart($customerid);
}
class Cart extends Database implements ICart{
    public function __construct(){
        parent::__construct();
    }
    /**
     * Retrieves the cart items for a specific customer.
     *
     * @param int $customerid The ID of the customer.
     * @return array The cart items for the customer.
     * @throws Exception If the cart is empty.
     */
    public function viewCart($customerid){
        $customerid = $this->escape_string($customerid);
        $query = "SELECT * FROM view_customer_cart WHERE customer_id = $customerid";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("Cart is empty!");
        return $rows;
    }
     /**
     * Adds a product to the customer's cart.
     *
     * @param array $params An array containing the product ID, customer ID, and quantity.
     * @return mixed Returns the result of the database operation.
     * @throws Exception If there is an error adding the product to the cart.
     */
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
     * Deletes a product from the customer's cart.
     *
     * @param array $params The parameters for deleting the product from the cart.
     *                      - productid: The ID of the product to be deleted.
     *                      - customerid: The ID of the customer.
     * @return int The number of rows affected by the deletion.
     * @throws Exception If unable to delete the product from the cart.
     */
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
    /**
     * Counts the number of items in the cart for a given customer.
     *
     * @param int $customerid The ID of the customer.
     * @return array The result of the query, containing the count of items in the cart.
     * @throws Exception If the cart is empty.
     */
    public function countCart($customerid){
        $customerid = $this->escape_string($customerid);
        $query = "SELECT count(*) as CartCount FROM view_customer_cart WHERE customer_id = $customerid";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("Cart is empty!");
        return $rows;
    }
}

?>