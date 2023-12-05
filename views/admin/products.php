<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../../public/admin/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../../public/admin/assets/css/styles.min.css" />
  <link rel="stylesheet" href="../../public/admin/assets/css/modal/modal.css"/>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="../../public/admin/assets/images/logos/dark-logo.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
         <!-- Sidebar navigation-->
         <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
              <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Home</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="./index.php" aria-expanded="false">
                  <span>
                    <i class="ti ti-layout-dashboard"></i>
                  </span>
                  <span class="hide-menu">Dashboard</span>
                </a>
              </li>
              <li class="sidebar-item">
                  <a class="sidebar-link" href="./sales.php" aria-expanded="false">
                    <span>
                      <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Sales</span>
                  </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="./products.php" aria-expanded="false">
                      <span>
                        <i class="ti ti-layout-dashboard"></i>
                      </span>
                      <span class="hide-menu">Products</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a class="sidebar-link" href="./orders.php" aria-expanded="false">
                      <span>
                        <i class="ti ti-layout-dashboard"></i>
                      </span>
                      <span class="hide-menu">Orders</span>
                    </a>
                  </li>
                </ul>
            </nav>
      </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../../public/admin/assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Products</h5> <hr>
            <div class=" d-flex justify-content-center">
              <button class="btn btn-info" id="myBtn">Add Product</button>
            </div>
            <!--Modal Starts Here-->
                <div id="myModal" class="modal">
                <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <hr>
                        <h4 class="card-title mb-4">Product Information</h5>
                        <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1">
                                <!--<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Product Desc</label>
                                <textarea class="form-control" name="" id="" cols="15" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                 <div class="input-group">
                                    <span class="input-group-text" id="">Product Price</span>
                                    <input type="number" class="form-control" style="width: 10%;" id="exampleInputEmail1">
                                    <span class="input-group-text" id="">Product Category</span>
                                    <select name="category" class="form-control" id="">
                                        <option value="Add On">Add on</option>
                                        <option value="Main Dish">Main Dish</option>
                                        <option value="Side Dish">Side Dish</option>
                                    </select>
                                 </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Tonkatsu</td>
                        <td>Masarap</td>
                        <td>Php 85.00</td>
                        <td><input type="submit" class="btn btn-success" value="Update">
                          <br>
                          <input type="submit" class="btn btn-danger mt-1" value="Delete"></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Honey Beef BBQ</td>
                        <td>Sobrang sarap</td>
                        <td>Php 99.00</td>
                        <td><input type="submit" class="btn btn-success" value="Update">
                          <br>
                        <input type="submit" class="btn btn-danger mt-1" value="Delete"></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Tapsilog</td>
                        <td>Best Tapsi</td>
                        <td>Php 85.00</td>
                        <td><input type="submit" class="btn btn-success" value="Update">
                          <br>
                        <input type="submit" class="btn btn-danger mt-1" value="Delete"></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Tocilog</td>
                        <td>Mekus Mekus</td>
                        <td>Php 85.00</td>
                        <td><input type="submit" class="btn btn-success" value="Update">
                          <br>
                        <input type="submit" class="btn btn-danger mt-1" value="Delete"></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Cornsilog</td>
                        <td>The best</td>
                        <td>Php 85.00</td>
                        <td><input type="submit" class="btn btn-success" value="Update">
                          <br>
                        <input type="submit" class="btn btn-danger mt-1" value="Delete"></td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Bento</td>
                        <td>Sobrang sarap</td>
                        <td>Php 85.00</td>
                        <td><input type="submit" class="btn btn-success" value="Update">
                          <br>
                        <input type="submit" class="btn btn-danger mt-1" value="Delete"></td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>Teriyaki</td>
                        <td>Yum yum yum</td>
                        <td>Php 85.00</td>
                        <td><input type="submit" class="btn btn-success" value="Update">
                          <br>
                        <input type="submit" class="btn btn-danger mt-1" value="Delete"></td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../public/admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../public/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../public/admin/assets/js/sidebarmenu.js"></script>
  <script src="../../public/admin/assets/js/app.min.js"></script>
  <script src="../../public/admin/assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../../public/admin/js/modal.js"></script>
</body>

</ht