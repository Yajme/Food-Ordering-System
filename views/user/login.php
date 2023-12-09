<?php 
include_once '../partials/shop-header.php';

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
        <div class="row px-xl-5 mx-auto"> 
            <h2 class="section-title position-relative text-uppercase mx-auto mb-4">Login</h2>
        </div>

        <div class="row px-xl-5">
            <!--how do i center from this -->
            <div class="col-lg-7 mb-5 mx-auto">
                    <?php if(isset($_SESSION['Message'])){?>
                        <p class="help-block text-success">
                            <?php echo $_SESSION['Message'];
                            unset($_SESSION['Message']); 
                            ?>
                        </p>
                    <?php }?>    
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
                            <p class="float-right">Don't have account?<a href="signup">Sign up</a></p>
                            
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary py-2 px-4" name="login">Login</button>
                    </form>
                    
            </div>
            <div class="col-lg-7 mb-5">
            
            </div>
            <!--to this -->
        </div>
    </div>
    <!-- Login End -->


<?php include '../partials/shop-footer.php'?>