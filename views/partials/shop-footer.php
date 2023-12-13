
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="index"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="Shop"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <?php if(!isset($_SESSION['user_name'])){?>
                                <a class="text-secondary mb-2" href="login"><i class="fa fa-angle-right mr-2"></i>Login</a>
                                <a class="text-secondary mb-2" href="signup"><i class="fa fa-angle-right mr-2"></i>Signup</a>
                            <?php }else{ ?>
                                <a class="text-secondary mb-2" href="cart"><i class="fa fa-angle-right mr-2"></i>Cart</a>
                                <a class="text-secondary mb-2" href="order"><i class="fa fa-angle-right mr-2"></i>Orders</a>
                                <a class="text-secondary mb-2" href="address"><i class="fa fa-angle-right mr-2"></i>Address Book</a>
                            <?php }?>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">BogZiLog</a>. All Rights Reserved. 
                </p>
            </div>
            <div class="col-lg-2">
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="https://www.facebook.com/bogsZilogs"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
            <div class="col-md-4 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="../../public/user/img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/user/lib/easing/easing.min.js"></script>
    <script src="../../public/user/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="../../public/user/mail/jqBootstrapValidation.min.js"></script>
    <script src="../../public/user/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="../../public/user/js/main.js"></script>
</body>

</html>