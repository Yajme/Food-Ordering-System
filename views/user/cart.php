<?php include_once '../partials/shop-header.php';

try{
    $customer = new CustomerController();
        $Total = 0.00;
    if(!isset($_POST['product_id'])){
        //$customer->Cart('deleteCart',$_POST['delete']);
        
        $Cart = (isset($_COOKIE['customerid'])) ? ExecuteObject(new CustomerController(),'Cart','viewCart',$_COOKIE['customerid']) : NULL;
    }else{
        $data = array(
            'productid' => $_POST['product_id'],
            'customerid' => $_COOKIE['customerid']
        );
        ExecuteObject(new CustomerController(),'Cart','deleteCart',$data);
        $Cart = ExecuteObject(new CustomerController(),'Cart','viewCart',$_COOKIE['customerid']);
        
    }
}catch(Exception $e){
    $Cart = NULL;
    $_SESSION['errorCart'] = $e->getMessage();
}
?>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <?php if(isset($_SESSION['errorCart']) && isset($_COOKIE['customerid'])){ ?>
            <?php echo '<div class="alert alert-danger">'.$_SESSION['errorCart'].'</div>';  unset($_SESSION['errorCart']);}?>
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <!--Cart Item start-->
                        <?php 
                        if($Cart){
                        foreach($Cart as $product): ?>
                        <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;"> <?php echo $product['product_name']?></td>
                            
                            <td class="align-middle"> <?php echo '₱'.$product['price']?></td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    
                                    <input type="text" id="itemQuantity" class="form-control form-control-sm bg-secondary border-0 text-center" value="<?php echo $product['quantity']?>" readonly>
                                    
                                </div>
                            </td>
                            <td class="align-middle"><?php echo '₱'.$product['cart_total']?></td>
                            <form method="POST">
                                <input type="hidden" name="product_id" id="productid" value="<?php echo $product['product_id']?>">
                            <td class="align-middle"><button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                            </form>
                        </tr>
                        <?php $Total += $product['cart_total']; ?> 
                        <?php endforeach; }else if(!isset($_COOKIE['customerid'])){?>
                            <div class="bg-light p-30 mb-5">
                            <h6 class="font-weight-medium"><?php echo 'Login to see cart' ?></h6>
                            </div>
                        <?php }?>
                        <!--Cart Item End-->
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><?php echo '₱'.$Total ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium"><?php echo '₱'.$Shipping=  ($Total>0) ? 100 : 0;?></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="CartTotal" ><?php echo '₱'.$Total+$Shipping; ?></h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" onclick="window.location.assign('checkout');" <?php if(!$Cart) {echo 'disabled';}    ?> >Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    <script> 
    </script>

   <?php include_once '../partials/shop-footer.php'; ?>