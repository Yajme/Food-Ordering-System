<?php
include_once('../../model/ordermodel.php');
/**
 * The Order class is an abstract class that serves as a base class for different types of orders.
 * It provides common functionality for viewing, updating, and grouping orders.
 */
abstract class Order{
    protected $OrderModel;
    
    /**
     * Constructs a new Order object.
     *
     * @param OrderModel $OrderModel The OrderModel object used for data access.
     */
    public function __construct(OrderModel $OrderModel){
        $this->OrderModel = $OrderModel;
    }
    
    /**
     * Retrieves and groups the orders based on the given parameters.
     *
     * @param array $params The parameters used for filtering the orders.
     * @return array The grouped orders.
     * @throws Exception If an error occurs while retrieving or grouping the orders.
     */
    public function viewOrder($params){
        try{
            return $this->groupOrder($this->OrderModel->viewOrder($params));
        }catch(Exception $e){
            throw $e;
        }
    }
    
    /**
     * Retrieves the details of a specific order.
     *
     * @param array $params The parameters used for identifying the order.
     * @return array The order details.
     * @throws Exception If an error occurs while retrieving the order details.
     */
    public function viewOrderDetail($params){
        try{
            return $this->OrderModel->viewOrderDetail($params);
        }catch(Exception $e){
            throw $e;
        }
    }
    
    /**
     * Updates the specified order with the given parameters.
     *
     * @param array $params The parameters used for updating the order.
     * @return bool True if the order is successfully updated, false otherwise.
     * @throws Exception If an error occurs while updating the order.
     */
    public function updateOrder($params){
        try{
            return $this->OrderModel->updateOrder($params);
        }catch(Exception $e){
            throw $e;
        }
    }
    
    /**
     * Groups the given array of orders based on the order_id.
     *
     * @param array $array The array of orders to be grouped.
     * @return array The grouped orders.
     */
    private function groupOrder($array){
        $group = array();
        foreach($array as $item){
            $group[$item['order_id']][] = $item;
        }
        
        return $group;
    }
}

/**
 * Represents a user order.
 * Extends the base Order class.
 */
class UserOrder extends Order{
    /**
     * Constructs a new UserOrder object.
     * 
     * @param OrderModel $OrderModel The order model associated with the user order.
     */

    public function __construct(OrderModel $OrderModel){
        parent::__construct( $OrderModel);
    }
    
    /**
     * Method to prepare and display orders based on the given parameters.
     *
     * @param array $params The array of orders to be prepared.
     * @return void
     * @throws Exception If an error occurs while preparing the orders.
     */
    public function preparingOrders($params){
        try{
            //var_dump($params);
            $count = 0;
            foreach($params as $orderid){
                
                if($orderid[0]['order_status'] =='Preparing'){
                    $count++;
                    echo '
                    <div class="row mb-3 p-5">
                    <div class="col center p-4">
                    <a href="order?product='.$orderid[0]['order_id'].'" class="btn btn-primary">View</a> <br> <br>
                    <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        
                                    </tr>
                                </thead>';
                foreach($orderid as $item){
                    if($item['order_status'] == 'Preparing'){
                        echo '
                                
                                <tbody>
                                
                                    <tr>
                                        <td>'.$item['product_name'].'</td>
                                        <td>'.$item['quantity'].'</td>
                                        <td>'.$item['price'].'</td>
                                        
                                    </tr>
                                
                                </tbody>
                                
                            ';
                    }
                }
                echo '</table> </div></div>';
                }
            }
            if($count == 0){
                echo '<div class="row mb-3 p-5">
                <div class="col center p-4">
                <h4 class="mb-3">No Orders</h4>
                </div>
                </div>';
            }
        }catch (Exception $e){
            throw $e;
        }
    }

    /**
     * This method displays shipping orders based on the given parameters.
     *
     * @param array $params The array of order IDs and their details.
     * @return void
     */
    public function shippingOrders($params){
        $count = 0;
        foreach($params as $orderid){
            
            if($orderid[0]['order_status'] =='Shipping'){ 
                $count++;
                echo '
                    <div class="row mb-3 p-5">
                    <div class="col center p-4">
                    <a href="order?product='.$orderid[0]['order_id'].'" class="btn btn-primary">View</a> <br> <br>
                    <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        
                                    </tr>
                                </thead>';
                foreach($orderid as $item){
                    
                        echo '
                                
                                <tbody>
                                
                                    <tr>
                                        <td>'.$item['product_name'].'</td>
                                        <td>'.$item['quantity'].'</td>
                                        <td>'.$item['price'].'</td>
                                        
                                    </tr>
                                
                                </tbody>
                                
                            ';
                    
                }
                echo '</table> </div></div>';
            }


        }
        if($count == 0){
            echo '<div class="row mb-3 p-5">
            <div class="col center p-4">
            <h4 class="mb-3">No Orders</h4>
            </div>
            </div>';
        }
    }

    /**
     * This method displays the delivered orders based on the given parameters.
     *
     * @param array $params The array of orders to be displayed.
     * @return void
     */
    public function deliveredOrders($params){
        $count = 0;
        foreach($params as $orderid){
            if($orderid[0]['order_status'] =='Delivered'){ 
                $count++;
                echo '
                        
                    
                    <div class="row mb-3 p-5">
                    <div class="col center p-4">
                    <a href="order?product='.$orderid[0]['order_id'].'" class="btn btn-primary">View</a> <br> <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                        
                            </tr>
                        </thead>'
                        ;
                foreach($orderid as $item){
                    
                        echo '
                                
                                <tbody>
                                
                                    <tr>
                                        <td>'.$item['product_name'].'</td>
                                        <td>'.$item['quantity'].'</td>
                                        <td>'.$item['price'].'</td>
                                        
                                    </tr>
                                
                                </tbody>
                                
                            ';
                    
                }
                echo '
                </table> 
                <form action="order" method="post">
                <input type="hidden" name="orderid" value="'.$orderid[0]['order_id'].'">
                <input type="hidden" name="customerid" value="'.$_COOKIE['customerid'].'">
                <input type="submit" name="received" value="Recieved" class="btn btn-primary float-right"> <br> <br>

                </form>
                </div>
                
                
                 
                </div>';
            }
                

        }
        if($count == 0){
            echo '<div class="row mb-3 p-5">
            <div class="col center p-4">
            <h4 class="mb-3">No Orders</h4>
            </div>
            </div>';
        }
    }
    /**
     * This method displays the received orders based on the given parameters.
     *
     * @param array $params The array of orders to be displayed.
     * @return void
     */
    
    public function receivedOrders($params){
        $count = 0;
        foreach($params as $orderid){
            if($orderid[0]['order_status'] =='Recieved'){ 
                $count++;
                echo '
                        
                    
                    <div class="row mb-3 p-5">
                    <div class="col center p-4">
                    <a href="order?product='.$orderid[0]['order_id'].'" class="btn btn-primary">View</a> <br> <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                        
                            </tr>
                        </thead>'
                        ;
                foreach($orderid as $item){
                    
                        echo '
                                
                                <tbody>
                                
                                    <tr>
                                        <td>'.$item['product_name'].'</td>
                                        <td>'.$item['quantity'].'</td>
                                        <td>'.$item['price'].'</td>
                                        
                                    </tr>
                                
                                </tbody>
                                
                            ';
                    
                }
                echo '
                </table> 
                
                </div>
                
                
                 
                </div>';
            }
                

        }
        if($count == 0){
            echo '<div class="row mb-3 p-5">
            <div class="col center p-4">
            <h4 class="mb-3">No Orders</h4>
            </div>
            </div>';
        }
    }
}


?>