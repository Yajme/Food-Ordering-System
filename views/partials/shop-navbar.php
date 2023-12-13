<?php 
/**
 * Loads details by calling a method on a CustomerController object.
 *
 * @param CustomerController $Controller The CustomerController object.
 * @param string $object The name of the method to call on the CustomerController object.
 * @param string $method The name of the method to call on the CustomerController object.
 * @param array|null $params Optional parameters to pass to the method.
 * @return mixed The result of the method call.
 */
function ExecuteObject(ICustomer $Interface,$object,$method,$params=null){
    return $Interface->$object($method,$params);
}

try{
    $cart = array(
        0 => array(
            'CartCount' => 0
        )
    );
    $CartCount = (isset($_COOKIE['customerid'])) ? ExecuteObject(new CustomerController(),'Cart','countCart',$_COOKIE['customerid']) : $cart;
    $count = $CartCount[0]['CartCount'];
}catch(Exception $e){
    throw $e;
}
?>
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-4">
            <a href="index">
                <img class="resized-image" src="../../public/assets/Untitled design1.png">
            </a>
        </div>

        <div class="col-lg-6 col-md-4 mt-md-2">
            <form name="Search" Action="shop" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products" name="product">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-3 col-md-4 text-right">
            <a href="" class="btn px-0">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
            </a>
            <a href="cart" class="btn px-0 ml-3">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo $count?></span>
            </a>
        </div>
    </div>
</div>
