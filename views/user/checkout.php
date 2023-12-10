<?php include_once '../partials/shop-header.php';
try{
    
    
if(!isset($_SESSION['user_name'])) header('location: index.php');

/**
 * Process the form submission for checkout.
 *
 * @param array $_POST The form data submitted.
 * @return void
 */
if(isset($_POST['submit'])){
    if(!isset($_POST['payment'])) throw new Exception("Please select a payment method");
    $Controller = new CustomerController();
    $Customerid = $_COOKIE['customerid'];
    $data = array(
        'customerid' => $Customerid,
        'payment' => $_POST['payment'],
        'address' =>$Controller->User('getAddress',$Customerid),
        'cart'=>$Controller->Cart('viewCart',$Customerid),
        'total'=> $_SESSION['total']
    );
    $Controller->User('checkout',$data);
    
    $_SESSION['message'] = "Order Placed Successfully";
     echo "<script>window.location.href='index';</script>";
}
/**
 * This script handles the checkout process for a user.
 * It checks if the user is logged in, retrieves the user's address and cart details,
 * and displays the available payment methods.
 */

if(isset($_GET)){
    
    $Controller = new CustomerController();
    $count = $Controller->Cart('countCart',$_COOKIE['customerid']);
    
    if($count[0]['CartCount']>0){
        $data = loadOrderDetails();
        $address = $data['address'];
        $payment = $data['payment'];
        $cart = $data['cart'];
    }else{
        header('location: index');
        exit();
    }
    
    

}
}catch(Exception $e){
    try{
        $_SESSION['errorMessage'] = $e->getMessage();
    }catch(Exception $e){
        $_SESSION['errorMessage'] = $e->getMessage();
    }
    
}

 function loadOrderDetails(){
    
    if(!isset($_COOKIE['customerid'])){
        $_SESSION['message'] = "Please login to continue";
        header('location: index.php');
    }
    $Controller = new CustomerController();
    $Customerid = $_COOKIE['customerid'];
    $address = $Controller->User('getAddress',$Customerid);
    $cart = $Controller->Cart('viewCart',$Customerid);
    $payment = $Controller->User('viewPaymentMethod');
    if(!$cart) header('location: index');  
    $data = array(
        'customerid' => $Customerid,
        'address' =>$Controller->User('getAddress',$Customerid),
        'cart'=>$cart,
        'payment' => $Controller->User('viewPaymentMethod')
    );
    return $data;
}
?>

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <form action="checkout" method="post" name="form">
    <div class="container-fluid">
        <?php if(isset($_SESSION['message'])){?>
            <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['message']; 
            unset($_SESSION['message']);?>
            </div>
        <?php }?>
        <?php if(isset($_SESSION['errorMessage'])){?>
            <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['errorMessage']; 
            unset($_SESSION['errorMessage']);?>
            </div>
        <?php }?>
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="First Name" value="<?php echo $address[0]['firstname'];?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Last Name" value="<?php echo $address[0]['lastname'];?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="Email" value="<?php echo $address[0]['email'];?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="Phone" value="<?php echo $address[0]['phone'];?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="Street" value="<?php echo $address[0]['street_number'];?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2 (Optional)</label>
                            <input class="form-control" type="text" placeholder="Building/House Number" value="<?php echo $address[0]['building_no'];?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Barangay</label>
                            <select class="custom-select" name="barangay" required>
                                <option selected><?php echo $address[0]['barangay'];?></option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York" value="<?php echo $address[0]['municipality'];?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Postal Code</label>
                            <input class="form-control" type="text" placeholder="Postal Code" value="<?php echo $address[0]['postal_code'];?>" required>
                        </div>
                        <div class="col-md-12">
                           
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <!-- Product List --> 
                        <?php if($cart){ ?>
                        <?php $total = 0; foreach($cart as $item):?>
                        <div class="d-flex justify-content-between">
                            <p><?php echo $item['product_name'] ?></p>
                            <p><?php echo '₱'.$item['cart_total'] ?></p>
                        </div>
                        <?php $total += $item['cart_total'] ?>
                        <?php endforeach;?>
                        <?php }else {?>
                        <!-- Product List -->
                        <div class="d-flex justify-content-between">
                            <p>No Items in Cart</p>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6><?php echo '₱'.$total; $_SESSION['total'] = $total; ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium"><?php echo '₱'.$shipping=100; ?></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?php echo '₱'.$shipping+$total ?></h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <?php foreach($payment as $method):?>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="<?php echo $method['payment_name']?>" value="<?php echo $method['payment_name']?>">
                                <label class="custom-control-label" for="<?php echo $method['payment_name']?>"><?php echo $method['payment_name']?></label>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <button type="submit" value="submit "class="btn btn-block btn-primary font-weight-bold py-3" name="submit">Place Order</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    </form>
    <!-- Checkout End -->
            <script>
        
    
</script>
            
<?php include_once '../partials/shop-footer.php';?>