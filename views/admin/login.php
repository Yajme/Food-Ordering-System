<?php
  session_start();
  include_once('../../model/adminmodel.php');
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $orders = new adminProduct();
    $orders->authenticateAdmin($username,$password);
    if(!$orders->authenticateAdmin($username,$password)) $errorMessage = 'Invalid username or password';
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Bogszilogs</title>
  <link rel="shortcut icon" type="image/png" href="../../public/admin/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../../public/admin/assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../../public/assets/Untitled design1.png" width="180" alt="">
                </a>
                <p class="text-center">Log in as Administrator</p>
                <form method="POST">
                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username">
                  </div>
                  <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                  <input type="submit" class="btn btn-primary" name="login" value="Login">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../public/admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../public/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>