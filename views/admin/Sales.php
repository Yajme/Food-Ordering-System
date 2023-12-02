<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

     <!-- Favicon -->
     <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../public/admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../public/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../public/admin/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="../../public/admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="Sales.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Sales</a>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Products</a>
                    <a href="#" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Orders</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Blank Start -->
            <div class="col-sm-20 col-xl-20">
                        <div class="bg-light rounded h-100 p-4">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
            </div>

            <!-- Blank End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../public/admin/lib/chart/chart.min.js"></script>
    <script src="../../public/admin/lib/easing/easing.min.js"></script>
    <script src="../../public/admin/lib/waypoints/waypoints.min.js"></script>
    <script src="../../public/admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../../public/admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../../public/admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../../public/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../public/admin/js/main.js"></script>
    <script>
            window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Bogszilogs Sales"
                },
                axisX: {
                    valueFormatString: "MMM YYYY"
                },
                axisY2: {
                    title: "Product",
                    prefix: "₱"
                },
                toolTip: {
                    shared: true
                },
                legend: {
                    cursor: "pointer",
                    verticalAlign: "top",
                    horizontalAlign: "center",
                    dockInsidePlotArea: true,
                    itemclick: toogleDataSeries
                },
                data: [{
                    type:"line",
                    axisYType: "secondary",
                    name: "Bento",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "₱#,###",
                    dataPoints: [		
                        { x: new Date(2023, 00, 01), y: 850 },
                        { x: new Date(2023, 01, 01), y: 889 },
                        { x: new Date(2023, 02, 01), y: 890 },
                        { x: new Date(2023, 03, 01), y: 899 },
                        { x: new Date(2023, 04, 01), y: 903 },
                        { x: new Date(2023, 05, 01), y: 925 },
                        { x: new Date(2023, 06, 01), y: 899 },
                        { x: new Date(2023, 07, 01), y: 875 },
                        { x: new Date(2023, 08, 01), y: 927 },
                        { x: new Date(2023, 09, 01), y: 949 }
                    ]
                },
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Honey BBQ Beef",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "₱#,###",
                    dataPoints: [
                        { x: new Date(2023, 00, 01), y: 1200 },
                        { x: new Date(2023, 01, 01), y: 1200 },
                        { x: new Date(2023, 02, 01), y: 1190 },
                        { x: new Date(2023, 03, 01), y: 1180 },
                        { x: new Date(2023, 04, 01), y: 1250 },
                        { x: new Date(2023, 05, 01), y: 1270 },
                        { x: new Date(2023, 06, 01), y: 1300 },
                        { x: new Date(2023, 07, 01), y: 1300 },
                        { x: new Date(2023, 08, 01), y: 1358 },
                        { x: new Date(2023, 09, 01), y: 1410 }
                        
                    ]
                },
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Tosilog",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "₱#,###",
                    dataPoints: [
                        { x: new Date(2023, 00, 01), y: 409 },
                        { x: new Date(2023, 01, 01), y: 415 },
                        { x: new Date(2023, 02, 01), y: 419 },
                        { x: new Date(2023, 03, 01), y: 429 },
                        { x: new Date(2023, 04, 01), y: 429 },
                        { x: new Date(2023, 05, 01), y: 450 },
                        { x: new Date(2023, 06, 01), y: 450 },
                        { x: new Date(2023, 07, 01), y: 445 },
                        { x: new Date(2023, 08, 01), y: 450 },
                        { x: new Date(2023, 09, 01), y: 450 }
                    ]
                },
                {
                    type: "line",
                    axisYType: "secondary",
                    name: "Teriyaki",
                    showInLegend: true,
                    markerSize: 0,
                    yValueFormatString: "₱####",
                    dataPoints: [
                        { x: new Date(2023, 00, 01), y: 529 },
                        { x: new Date(2023, 01, 01), y: 540 },
                        { x: new Date(2023, 02, 01), y: 539 },
                        { x: new Date(2023, 03, 01), y: 565 },
                        { x: new Date(2023, 04, 01), y: 575 },
                        { x: new Date(2023, 05, 01), y: 579 },
                        { x: new Date(2023, 06, 01), y: 589 },
                        { x: new Date(2023, 07, 01), y: 579 },
                        { x: new Date(2023, 08, 01), y: 579 },
                        { x: new Date(2023, 09, 01), y: 579 }
                        
                    ]
                }]
            });
            chart.render();

            function toogleDataSeries(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else{
                    e.dataSeries.visible = true;
                }
                chart.render();
            }

            }
    </script>

</body>

</html>