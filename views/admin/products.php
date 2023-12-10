<?php
include_once('../../model/adminmodel.php');
session_start();

if (isset($_POST['addProd'])) {
  try{
      $prodName = $_POST["prodName"];
      $prodDesc = $_POST['prodDesc'];
      $prodPrice = $_POST['prodPrice'];
      $prodCat = $_POST['category'];
      $prodImage = $_FILES["imagePath"]["name"];
      $product = new adminProduct();
      $product->addProduct($prodName,$prodDesc,$prodPrice,$prodCat,$prodImage);
      header('location: products.php');

  }catch(Exception $e){
      $_SESSION['errorMessage'] = $e -> getMessage();
      header('location: products.php');
  }
}

if (isset($_POST['updateProd'])) {
  try{
      $prodID = $_POST['product_id'];
      $prodName = $_POST['prodName'];
      $prodDesc = $_POST['prodDesc'];
      $prodPrice = $_POST['price'];
      $product = new adminProduct();
      $product->updateProduct($prodName,$prodDesc,$prodPrice,$prodID);
      header('location: products.php');

  }catch(Exception $e){
      $_SESSION['errorMessage'] = $e -> getMessage();
      header('location: products.php');
  }
}

if (isset($_POST['deleteProd'])) {
  try{
      $prodID = $_POST['product_id'];
      $product = new adminProduct();
      $product->deleteProduct($prodID);
      header('location: products.php');

  }catch(Exception $e){
      $_SESSION['errorMessage'] = $e -> getMessage();
      header('location: products.php');
  }
}
$products = new adminProduct();
$productView = $products->loadProducts();
?>
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
        <?php
            include('../partials/admin-sidenav.php')
        ?>
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
            <?php
              include('admin-modal.php');
              include('admin-upmodal.php');
            ?>
            <br>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($productView as $availableProducts):?>
                    <tr>
                      
                        <th scope="row"><?php echo $availableProducts['ID']; ?></th>
                        <td><?php echo $availableProducts['Product Name']; ?></td>
                        <td><?php echo $availableProducts['Description']; ?></td>
                        <td><?php echo $availableProducts['Category']; ?></td>
                        <td><?php echo $availableProducts['Price']; ?></td>
                        <td><button class="btn btn-success"onclick="openModal(<?php echo $availableProducts['ID']; ?>)">Update</button>
                            <button class="btn btn-danger"onclick="openDeleteModal(<?php echo $availableProducts['ID']; ?>)">Delete</button></td>
                      
                    </tr>
                  <?php endforeach; ?>
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
  <script>
    // JavaScript functions for opening/closing modals
    function openModal(productId) {
        document.getElementById('updateProductId').value = productId;
        document.getElementById('updateModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('updateModal').style.display = 'none';
    }

    function openDeleteModal(productId) {
        document.getElementById('deleteProductId').value = productId;
        document.getElementById('deleteModal').style.display = 'block';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }
</script>
</body>

</html>