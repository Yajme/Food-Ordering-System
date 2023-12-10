<?php
include_once('../../db/connection.php');
interface IOrder{
    public function viewOrder($params);
    public function viewOrderDetail($params);
    public function updateOrder($params);

}
abstract class OrderModel extends Database implements IOrder{
   
    public function __construct(){
        parent::__construct();
    }

    public abstract function viewOrder($params);
    public abstract function viewOrderDetail($params);
    public abstract function updateOrder($params);

}


class UserOrderModel extends OrderModel{
    public function __construct(){
        parent::__construct();
    }
    /**
     * Retrieves the orders for a specific customer.
     *
     * @param $params customerID.
     *                orderID.
     * @return array The array of orders for the customer.
     * @throws Exception If unable to retrieve the orders.
     */
    public function viewOrder($params){
        try{
            $customerid = $this->escape_string($params);
            $query = "SELECT * FROM `view_customer_order` WHERE `customer_id` = '$customerid' ORDER BY created_at DESC";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to get orders");
            return $rows;
        }catch(Exception $e){
            throw $e;
        }
    }
    public function viewOrderDetail($params){
        try{

            $customerid = $this->escape_string($params['customerid']);
            $orderid = $this->escape_string($params['orderid']);
            $query = "SELECT * FROM `view_customer_order` WHERE `customer_id` = '$customerid' AND `order_id` = '$orderid'";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to get orders");
            return $rows;
        }catch(Exception $e){
            throw $e;
        }
    }
    public function updateOrder($params){
        try{
            $this->connection->autocommit(FALSE);
            $orderid = $this->escape_string($params);
            $query = "CALL OrderStatusUpdate('$orderid')";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to get orders" . $this->connection->error);
            $this->connection->commit();
            return $rows;
            
        }catch(Exception $e){
            $this->connection->rollback();
            throw $e;
        }
    }
    public function updateOrderDetail($params){
        try{
            $customerid = $this->escape_string($params['customerid']);
            $orderid = $this->escape_string($params['orderid']);
            $query = "SELECT * FROM `view_customer_order` WHERE `customer_id` = '$customerid' AND `order_id` = '$orderid'";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to get orders");
            return $rows;
            
        }catch(Exception $e){
            throw $e;
        }
    }
    public function orderDetail(){
        try{
            $query = "SELECT * FROM `orderview` ORDER BY order_id ASC";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to get orders");
            return $rows;
            
        }catch(Exception $e){
            throw $e;
        }
    }
    public function orderDetails(){
        try{
            $query = "SELECT nw.product_id, nw.image_path, nw.product_name, nw.price, nw.quantity, ordetail.total_amount ,nw.customer_id, cust.firstname,cust.lastname ,nw.order_id, nw.order_status, nw.created_at 
            FROM view_customer_order as nw inner join tbl_customer as cust on nw.customer_id = cust.customer_id
            inner join tbl_order_details as ordetail on ordetail.order_id =  nw.order_id;";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to get orders");
            return $rows;
            
        }catch(Exception $e){
            throw $e;
        }
    }
    
}
?>