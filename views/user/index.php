<?php include_once '../partials/shop-header.php';


/**
 * This code initializes an object of the CustomerController class and retrieves data for different sections of the user index page.
 * It loads categories, featured products, and recent products using the Products method of the CustomerController class.
 * If an exception occurs, the error message is stored in the session variable 'error'.
 */

try {
    // Initialize Object
    $Controller = new CustomerController();

    // Categories Section
    $categories = $Controller->Products('LoadCategories');

    // Featured Products Section
    $featuredProducts = $Controller->Products('LoadFeaturedProducts');
    
    // Recent Products Section
    $recentProducts = $Controller->Products('recentProducts');
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
}
?>
    
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <?php if(isset($_SESSION['message'])) {?>
            <div class="alert alert-success"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php } ?>
        <div class="row px-xl-5">
            <div class="col">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <!-- Carousel items -->

                    <div class="carousel-inner">
                        <!-- Carousel item-1 Start-->
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="../../public/assets/Bento.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Exquisite Bento Creations</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Savor the artistry in every bite with our carefully prepared Bento boxes. Satisfy your cravings with our wholesome and hearty Bento options.</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="shop">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel item-2 Start-->
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="../../public/assets/Tapsilog.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Silog Meals</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Start your day with a hearty Silog breakfast.  Taste the comfort of homestyle cooking in our Silog selections.</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="shop">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel item-3 Start-->
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="../../public/assets/PorkTonkatsu.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Tonkatsu</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Savor the melt-in-your-mouth goodness of our Tonkatsu, expertly prepared for a dining experience like no other.</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="shop">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Carousel items End -->
                </div>
            </div>
           
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Quality Product</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Low Cost Delivery</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="text-primary m-0 mr-3"><i class="fa-solid fa-bowl-food"></i></h1>
                    <h5 class="font-weight-semi-bold m-0">Exquisite Taste</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                <h1 class="text-primary m-0 mr-3"><i class="fa-solid fa-peso-sign"></i></h1>
                    <h5 class="font-weight-semi-bold m-0">Affordable Dishes</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
        <!--Categories Slider Start-->
        <div class="row px-xl-5 pb-3">
            <!--Categories Slider Item Start-->
            <?php foreach($categories as $category): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <a class="text-decoration-none" href="shop?category=<?php echo $category['Category']; ?>">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="overflow-hidden" style="width: 100px; height: 100px;">
                                <img class="img-fluid" src="<?php echo $category['image_path']; ?>" alt="">
                            </div>
                            <div class="flex-fill pl-3">
                                <h6><?php echo $category['Category']; ?></h6>
                                <small class="text-body"><?php echo $category['Products']; ?> Products</small>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            <!--Categories Slider Item End-->
        </div>
    </div>
    <!-- Categories End -->

    <!-- For Icon Such as fa fa-star
    https://fontawesome.com/icons?d=gallery&m=free
    fa fa-star text-primary mr-1 means full star
    fa fa-star-half-alt text-primary mr-1 means half star
    fa fa-star text-primary mr-1 means empty star
    -->
    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>

        <div class="row px-xl-5">
            <!--Featured Products Item Start-->
            <?php foreach($featuredProducts as $featuredProduct): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?php echo $featuredProduct['image_path']; ?> " alt="">
                    </div>
                    <div class="text-center py-4">
                        <!--Product Name-->
                        <a class="h6 text-decoration-none text-truncate" href="product?name=<?php echo $featuredProduct['ProductName']; ?>"><?php echo $featuredProduct['ProductName']; ?> </a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <!--Price-->
                            <h5><?php echo '₱'.$featuredProduct['Price']; ?> </h5><h6 class="text-muted ml-2"></h6>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!--Featured Products Item End-->
            
        </div>
    </div>
    <!-- Products End -->




    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Recent Products</span></h2>
        <div class="row px-xl-5">
            <!--recemt Products Item Start-->
            <?php foreach($recentProducts as $recentProduct): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?php echo $recentProduct['image_path']; ?> " alt="">
                    </div>
                    <div class="text-center py-4">
                        <!--Product Name-->
                        <a class="h6 text-decoration-none text-truncate" href="product?name=<?php echo $featuredProduct['ProductName']; ?>"><?php echo $recentProduct['Product Name']; ?> </a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <!--Price-->
                            <h5><?php echo '₱'.$recentProduct['Price']; ?> </h5><h6 class="text-muted ml-2"></h6>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!--Recent Products Item End-->
           
        </div>
    </div>
    <!-- Products End -->


   

<?php include_once '../partials/shop-footer.php'?>