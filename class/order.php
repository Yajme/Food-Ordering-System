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
            $show = 5;
            $keys = array_keys($params);
            if ($keys === range(0, count($params) - 1)) {
                $show = ($params[1]) ? $params[1] : '';
                $params = $params[0];

             }
             $all = ($show == '*') ? true : false;
            $count = 0;
            foreach($params as $orderid){
                if($orderid[0]['order_status'] =='Preparing'){ 
                    $count++;
                    echo '
                    <div class="vstack">
                    <a href="order?product='.$orderid[0]['order_id'].'" class="text-body mr-3">
                    <div class="container m-5">
                    <div class="row">
                        <div class="col-md-12 col-lg-9"><h4 class="mb-3">Order number: '.$orderid[0]['order_id'].'</h4></div>
                        <div class="col-lg-1 offset-lg-2 d-flex justify-content-center align-items-center" style="border:1px solid #cecece; border-radius: 10px;background-color: #dfe6e9;color: #2d3436;">
                            '.$orderid[0]['order_status'].'
                        </div>
                    </div>';
                    foreach($orderid as $item){
                        
                            echo '
                            <div class="row">
                            <div class="w-100"></div>
                            <div class="col-md-2"><img src="'.$item['image_path'].'" class="img-thumbnail"/></div>
                            <div class="col">'.$item['product_name'].'</div>
                            <div class="col">'.$item['price'].'</div>
                            <div class="col-md-2">'.$item['quantity'].'</div>

                        </div>  
                                    
                                ';
                        
                    }
                    echo '
                    </div>
                    </a>
                        
                    </div>';
                    if(!$all && $count==$show) break;
                }
    
    
            }
            if($count == 0){
                echo '<div class="row mb-3 p-5">
                <div class="col center p-4">
                <h4 class="mb-3">No Orders</h4>
                </div>
                </div>';
            }
        }catch(Exception $e){
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
        try{

            $show = 5;
            $keys = array_keys($params);
            if ($keys === range(0, count($params) - 1)) {
                $show = ($params[1]) ? $params[1] : '';
                $params = $params[0];
            }
            $all = ($show == '*') ? true : false;
            $count = 0;
            foreach($params as $orderid){
                if($orderid[0]['order_status'] =='Shipping'){ 
                    $count++;
                    echo '
                    <div class="vstack">
                    <a href="order?product='.$orderid[0]['order_id'].'" class="text-body mr-3">
                    <div class="container m-5">
                    <div class="row">
                        <div class="col-md-12 col-lg-9"><h4 class="mb-3">Order number: '.$orderid[0]['order_id'].'</h4></div>
                        <div class="col-lg-1 offset-lg-2 d-flex justify-content-center align-items-center" style="border:1px solid #cecece; border-radius: 10px;background-color: #dfe6e9;color: #2d3436;">
                            '.$orderid[0]['order_status'].'
                        </div>
                    </div>';
                    foreach($orderid as $item){
                        
                            echo '
                            <div class="row">
                            <div class="w-100"></div>
                            <div class="col-md-2"><img src="'.$item['image_path'].'" class="img-thumbnail"/></div>
                            <div class="col">'.$item['product_name'].'</div>
                            <div class="col">'.$item['price'].'</div>
                            <div class="col-md-2">'.$item['quantity'].'</div>

                        </div>  
                                    
                                ';
                        
                    }
                    echo '
                    </div>
                    </a>
                        
                    </div>';
                    if(!$all && $count==$show) break;
                }
    
    
            }
            if($count == 0){
                echo '<div class="row mb-3 p-5">
                <div class="col center p-4">
                <h4 class="mb-3">No Orders</h4>
                </div>
                </div>';
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    /**
     * This method displays the delivered orders based on the given parameters.
     *
     * @param array $params The array of orders to be displayed.
     * @return void
     */
    public function deliveredOrders($params){
        try{
            $show = 5;
            $keys = array_keys($params);
            if ($keys === range(0, count($params) - 1)) {
                $show = ($params[1]) ? $params[1] : '';
                $params = $params[0];
            }
            $all = ($show == '*') ? true : false;
            $count = 0;
            foreach($params as $orderid){
                if($orderid[0]['order_status'] =='Delivered'){ 
                    $count++;
                    echo '
                    <div class="vstack">
                    <a href="order?product='.$orderid[0]['order_id'].'" class="text-body mr-3">
                    <div class="container m-5">
                    <div class="row">
                        <div class="col-md-12 col-lg-9"><h4 class="mb-3">Order number: '.$orderid[0]['order_id'].'</h4></div>
                        <div class="col-lg-1 offset-lg-2 d-flex justify-content-center align-items-center" style="border:1px solid #cecece; border-radius: 10px;background-color: #dfe6e9;color: #2d3436;">
                            '.$orderid[0]['order_status'].'
                        </div>
                    </div>';
                    foreach($orderid as $item){
                        
                            echo '
                            <div class="row">
                            <div class="w-100"></div>
                            <div class="col-md-2"><img src="'.$item['image_path'].'" class="img-thumbnail"/></div>
                            <div class="col">'.$item['product_name'].'</div>
                            <div class="col">'.$item['price'].'</div>
                            <div class="col-md-2">'.$item['quantity'].'</div>

                        </div>  
                                    
                                ';
                        
                    }
                    echo '
                    </div>
                    </a>
                    <div class="row">
                    <div class="w-100"></div>
                    
                    <div class="col-lg-1 offset-lg-11">
                        <form action="order" method="post">
                        <input type="hidden" name="orderid" value="'.$orderid[0]['order_id'].'">
                        <input type="hidden" name="customerid" value="'.$_COOKIE['customerid'].'">
                        <input class="btn btn-primary" type="submit" name="received"value="Recieve">
                        </form>
                    </div>
                    <div class="w-100"></div>
                    
                    </div>
                    </div>';
                    if(!$all && $count==$show) break;
                }
    
    
            }
            if($count == 0){
                echo '<div class="row mb-3 p-5">
                <div class="col center p-4">
                <h4 class="mb-3">No Orders</h4>
                </div>
                </div>';
            }
        }catch(Exception $e){
            throw $e;
        }
    }
    /**
     * This method displays the received orders based on the given parameters.
     *
     * @param array $params The array of orders to be displayed.
     * @return void
     */
    
    public function receivedOrders($params){
        try{
            $show = 5;
            $keys = array_keys($params);
            if ($keys === range(0, count($params) - 1)) {
                $show = ($params[1]) ? $params[1] : '';
                $params = $params[0];
            }
            $all = ($show == '*') ? true : false;
            $count = 0;
            foreach($params as $orderid){
                if($orderid[0]['order_status'] =='Recieved'){ 
                    $count++;
                    echo '
                    <div class="vstack">
                    <a href="order?product='.$orderid[0]['order_id'].'" class="text-body mr-3">
                    <div class="container m-5">
                    <div class="row">
                        <div class="col-md-12 col-lg-9"><h4 class="mb-3">Order number: '.$orderid[0]['order_id'].'</h4></div>
                        <div class="col-lg-1 offset-lg-2 d-flex justify-content-center align-items-center" style="border:1px solid #cecece; border-radius: 10px;background-color: #dfe6e9;color: #2d3436;">
                            '.$orderid[0]['order_status'].'
                        </div>
                    </div>';
                    foreach($orderid as $item){
                        
                            echo '
                            <div class="row">
                            <div class="w-100"></div>
                            <div class="col-md-2"><img src="'.$item['image_path'].'" class="img-fluid img-thumbnail"/></div>
                            <div class="col">'.$item['product_name'].'</div>
                            <div class="col"> ₱'.$item['price'].'</div>
                            <div class="col-md-2">Qty '.$item['quantity'].'</div>
                        </div>  
                                    
                                ';
                        
                    }
                    echo '
                    </div>
                    </a>
                        
                    </div>';
                    if(!$all && $count==$show) break;
                }
    
    
            }
            if($count == 0){
                echo '<div class="row mb-3 p-5">
                <div class="col center p-4">
                <h4 class="mb-3">No Orders</h4>
                </div>
                </div>';
            }
        }catch(Exception $e){
            throw $e;
        }
    }
}

?>