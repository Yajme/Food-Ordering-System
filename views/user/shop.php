<?php include_once '../partials/shop-header.php';

try{
    $customer = new CustomerController();
    $categories = $customer->Products('loadCategories');
    if(!isset($_GET['product'])){
        if(isset($_GET['category'])){
            $products = $customer->Products('selectProductByCategory',array($_GET['category'])); 
        }else if(isset($_GET['price'])){
            $products = $customer->filterbyPrice($_GET['min'],$_GET['max']);
        }else{
            if(!isset($_SESSION['error']) ){
                $products = $customer->Products('selectAllProducts');
            }
        }
    }else{
        $products = $customer->Products('selectProductBySearch',$_GET['product']);
    }
}catch(Exception $e){
    $_SESSION['error'] = $e->getMessage();
}



?>

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">

            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form method="GET">
                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <input type="text" class="form-control" placeholder="MIN" name="min">
                            <span class="font-weight-normal">-</span>
                            <input type="text" class="form-control" placeholder="MAX"name="max">
                        </div>
                        <input type="submit" class="btn btn-primary py-2 px-4" id="color-1" name ="price"value="Apply">
                    </form>
                </div>
                <!-- Price End -->
                
                <!-- Category Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form method="GET">
                        <?php $i = 1; foreach($categories as $category): ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="cat-<?php echo $i ?>" name="category[]" value="<?php echo $category['Category']; ?>">
                            <label class="custom-control-label" for="cat-<?php echo $i ?>"><?php echo $category['Category'] ?></label>
                            <span class="badge border font-weight-normal"><?php echo $category['Products']; ?></span>
                        <?php $i++; ?>
                        </div>
                        <?php  endforeach; ?>
                            <br>
                        <input type="submit" class="btn btn-primary py-2 px-4 " id="color-1" value="Apply">
                    </form>
                </div>

                <!-- Category End -->

               
                <div class="bg-light p-4 mb-30">
                    <form method="GET" action="shop">
                        <input type="submit" class="btn btn-primary py-2 px-4" id="color-1" value="Clear Filters">
                    </form>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Shop Product Item Start -->
                    <?php if(isset($_SESSION['error'])){?>
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php  } else {?>
                    <?php foreach($products as $product): ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <a href="product?name=<?php echo $product['Product Name'] ?>">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="<?php echo $product['image_path'] ?>" alt="">
                            </div>
                            <div class="text-center py-4">
                                <!--Product Name-->
                                <p class="h6 text-decoration-none text-truncate"><?php echo $product['Product Name'] ?></p>

                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5><?php echo '₱'.$product['Price'] ?></h5>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <!--Shop Product Item End -->
                    
                    <div class="col-12">
                        <nav>
                          <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</span></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                          </ul>
                        </nav>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <?php include_once '../partials/shop-footer.php'?>