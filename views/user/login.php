<?php 
include_once '../partials/shop-header.php';

include_once '../../controller/customercontroller.php';

   

    // Check if the form is submitted
    if (isset($_POST['login'])) {
        try{
            $username = $_POST["username"];
            $password = $_POST['password'];

            $Controller = new CustomerController();
            $Controller->Login($username,$password);

        }catch(Exception $e){
            $_SESSION['errorMessage'] = $e -> getMessage();
        }
       
    }


?>
    <!-- Login Start -->
    <div class="container-fluid">
        <div class="row px-xl-5"> 
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">Login</h2>
        </div>

        <div class="row px-xl-5">

            <div class="col-lg-7 mb-5">
            <p class="help-block text-danger">
            <?php if(isset($_SESSION['errorMessage'])){ 
                echo $_SESSION['errorMessage'];
                unset($_SESSION['errorMessage']);
            }
            ?>
            </p>
                    <form  method="POST" action="login">

                        <div class="control-group">
                            <input type="text" class="form-control" name="username" placeholder="Username"
                                required="required"/>
                            <p class="help-block text-danger"></p>
                        </div>

                        <div class="control-group">
                            <input type="password" class="form-control" name="password" placeholder="Password"/>
                            <p class="help-block text-danger"></p>
                        </div>

                        <button type="submit" class="btn btn-primary py-2 px-4" name="login">Login</button>
                    </form>
            </div>


        </div>
    </div>
    <!-- Login End -->


<?php include '../partials/shop-footer.php'?>