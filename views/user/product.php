<?php include_once '../partials/shop-header.php';

/**
 * This code is responsible for handling the product page functionality.
 * It checks if the user is adding a product to the cart or accessing the product page directly.
 * If the user is accessing the product page directly, it retrieves the product details from the database.
 * If the user is adding a product to the cart, it checks if the user is logged in and adds the product to the cart.
 * If any exception occurs during the process, it captures the error message and stores it in the session.
 */
try{

    /**
     * This code block checks if the 'add-cart' POST parameter is not set.
     * If it is not set, it further checks if the 'name' GET parameter is not set.
     * If the 'name' GET parameter is not set, it redirects the user to the 'shop' page.
     * If the 'name' GET parameter is set, it retrieves the product details based on the 'name' parameter,
     * assigns the first product to the $product variable, and stores it in the $_SESSION['product'] variable.
     * 
     * If the 'add-cart' POST parameter is set, the code block does not execute any further actions.
     */
    if(!isset($_POST['add-cart'])){
        if(!isset($_GET['name'])){
            header('location: shop');
        }else{
            /**
             * Sets the product session variable to null, then retrieves a product from the customer object based on the provided name parameter.
             * The retrieved product is stored in the product session variable.
             *
             * @param string $name The name of the product to search for.
             * @return array of data of the product.
             */
            $_SESSION['product'] = null;
            $product = ExecuteObject(new CustomerController(),'Products','selectProductBySearch',$_GET['name']);
            $product = $product[0];
            $_SESSION['product'] = $product;
        }
    }else{
           
        /**
         * Checks if the 'customerid' cookie is set. If not, sets a session message and redirects to the login page.
         * 
         * @return void
         */
        if(!isset($_COOKIE['customerid'])){
            $_SESSION['Message'] = 'Login first to purchase products!';
            header('location: login.php');
        }else{
            /**
             * Adds a product to the cart.
             *
             * @param array $cart The cart details including product ID, quantity, and customer ID.
             * @return void
             */
            $product = $_SESSION['product'];
            $cart = array(
                'productid'=> $product['ID'],
                'quantity'=> $_POST['quantityForm'],
                'customerid'=>$_COOKIE['customerid']
            );
            //$customer->Cart('addToCart',array($cart));
            ExecuteObject(new CustomerController(),'Cart','addToCart',array($cart));
            $_SESSION['message'] = 'Product added to cart!';
        }
    }
}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
}


?>

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <?php if(isset($_SESSION['message'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['message']; 
                unset($_SESSION['message']);
                ?>
            </div>
            <?php } ?>
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop">Shop</a>
                    <span class="breadcrumb-item active"><?php echo $product['Product Name'] ?></span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="<?php echo $product['image_path']?>" alt="Image">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><?php echo $product['Product Name'] ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?php echo '₱'.$product['Price'] ?></h3>
                    <p class="mb-4"><?php echo $product['Description'] ?></p>
                    
                    
                    <div class="d-flex align-items-center mb-4 pt-2">
                        
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-minus" id="btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control bg-secondary border-0 text-center" value="1" name="quantity">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary btn-plus" id="btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                            </div> 
                           
                        
                            <form  method="post" id="product">
                            <input type="hidden" name="quantityForm" id="form-quantity" value="1">
                        <button type= "submit"  class="btn btn-primary px-3" id="add-cart" name="add-cart"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                        </form>
                        
                                
                    <script>
                        /**
                         * This code adds event listeners to the plus and minus buttons in the product view.
                         * When the plus button is clicked, it increases the quantity value by 1 and updates the form quantity value.
                         * When the minus button is clicked, it decreases the quantity value by 1 (if it is greater than 1) and updates the form quantity value.
                         */
                        document.getElementById('btn-plus').addEventListener('click',function(){
                            var quantity = document.querySelector('input[name="quantity"]');
                            quantity.value = parseInt(quantity.value) + 1;
                            document.querySelector('#form-quantity').value = quantity.value;
                        });

                        document.getElementById('btn-minus').addEventListener('click',function(){
                            var quantity = document.querySelector('input[name="quantity"]');
                            if(parseInt(quantity.value) > 1){
                                quantity.value = parseInt(quantity.value) - 1;
                                document.querySelector('#form-quantity').value = quantity.value;
                            }
                        });
                       
                        /**
                         * This code snippet attaches an event listener to a form submission event and handles the form submission.
                         * It prevents the default form submission behavior, retrieves the quantity value from input fields,
                         * and assigns it to the form quantity field.
                         *
                         * @param {Event} event - The form submission event.
                         */
                        const forms = document.querySelector('#product');
                        forms.addEventListener('submit', handleFormSubmission(event));
                        function handleFormSubmission(event) {
                            event.preventDefault(); 
                            var quantity = Number(document.querySelector('input[name="quantity"]').value);
                            var formQuantity = Number(document.querySelector('#form-quantity').value);
                            formQuantity = quantity;
                        }
                    </script>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Detail End -->
        <!--  -->
        
        <!--  -->
    </div>
    <!-- Shop Detail End -->




<?php include_once '../partials/shop-footer.php';?>