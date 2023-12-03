<?php session_start();?>
<div class="container-fluid">
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center justify-content-end h-100">
                <a class="text-body mr-3" href="index">Home</a>
                <a class="text-body mr-3" href="shop">Shop</a>
                <?php if(isset($_SESSION['user_name'])){ ?>
                    <!-- Add your dropdown HTML here -->
                    <form action="logout.php" method="post">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $_SESSION['user_name'] ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!-- Add a logout button inside the dropdown -->
                                <button type="submit" class="dropdown-item" name="logout">Logout</button>
                            </div>
                        </div>
                    </form>
                <?php }
                if(!isset($_SESSION['user_name'])){
                ?>
                <a class="text-body mr-3" href="login">Login</a>
                <a class="text-body mr-3" href="signup">Sign up</a>

                <?php
                echo $_COOKIE['userid'];
            }?>
            </div>
        </div>
    </div>
</div>
