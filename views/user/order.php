<?php include_once('../partials/shop-header.php'); 
/**
 * This script handles the checkout process for a user.
 * 
 */
if(!isset($_SESSION['user_name'])) header('location: index.php');
if(isset($_GET['product'])){
    
}

if(isset($_POST['received'])){
    try{
        $Order = new UserOrder(new UserOrderModel());
        $Order->updateOrder($_POST['orderid']);
        $_SESSION['Message'] = "Order Received";
    }catch(Exception $e){
        $_SESSION['errorMessage'] =  $e->getMessage();
    }
    
}
?>
<div class="container-fluid">
<?php if(isset($_SESSION['errorMessage'])){ ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); ?>
            </div>
        <?php }?>
        <?php if(isset($_SESSION['Message'])){ ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['Message']; unset($_SESSION['Message']); ?>
            </div>
        <?php }?>
    <div class="row px-xl-5">
        
        <div class="col">
            <div class="bg-light p-30">
                <?php 
                try{
                    if(!isset($_GET['product'])){
                        $controller = new CustomerController();
                        $data = $controller->Order('viewOrder',$_COOKIE['customerid']);
                        
                        include_once('./order_list.php');
                    }else{
                        $controller = new CustomerController();
                        $data = $controller->Order('viewOrderDetail',array('customerid'=>$_COOKIE['customerid'],'orderid'=>$_GET['product']));
        
                        include_once('./order_detail.php');
                    }
                }catch(Exception $e){
                    $_SESSION['errorMessage'] = $e->getMessage();
                }
            
                ?>
            </div>
        </div>
    </div>
</div>



                               
                           


<?php include_once('../partials/shop-footer.php'); ?>
