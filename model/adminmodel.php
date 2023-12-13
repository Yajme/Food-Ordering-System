<?php
require_once '../../utils/userinterface.php';
require_once '../../utils/authentication.php';
include_once('../../db/connection.php');
require_once '../../model/productmodel.php';
require_once '../../model/ordermodel.php';
class adminProduct extends Database {

    public function addProduct($name, $description, $price, $category,$imagePath) {
        $fileSize = $_FILES['imagePath']['size'];
        if( $fileSize > 1000000){
            echo "<script> alert('Image size is too large') </script>";
        }else{
        // Define the directory where the uploaded file will be moved
            $uploadDirectory = '../../public/assets/';
            // Set the complete path for the image
            $image = $uploadDirectory . $imagePath;
            // Move the uploaded file to the specified directory
            $tmpName = $_FILES['imagePath']['tmp_name'];
            move_uploaded_file($tmpName, $image);
            // Prepare the SQL query
            $query = "INSERT INTO tbl_product(product_name, product_description, price, category_id, image_path, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
            // Prepare the parameters
            $params = array($name, $description, $price, $category, $image);
            // Execute the SQL query with the parameters
            return $rows = $this->statementBind($query, $params);
        }
    }
    public function updateProduct($name, $description, $price,$id) {
        $query = "UPDATE tbl_product SET product_name = ?, product_description = ?, price = ?, modified_at = NOW() WHERE product_id = ?";
        $params = array($name, $description, $price, $id);
        return $rows = $this->statementBind($query, $params);
        if (!$rows) {
            throw new Exception("Product failed to be updated!");
        }
    }
    public function deleteProduct($id) {
        $query = "UPDATE tbl_product SET deleted_at = NOW() WHERE product_id = ?";
        $params = array($id);
        return $rows = $this->statementBind($query, $params);
        if (!$rows) {
            throw new Exception("Product failed to be updated!");
        }
    }
    public function loadProducts(){
        try{
            $product = new ProductModel();
            $availableProducts = $product->selectAllProducts();
            return $availableProducts;
        }catch(Exception $e){
            throw $e;
        }
    }
    public function loadOrders(){
        try{
            $orderModel = new UserOrderModel();
            $orders = $orderModel->orderDetail();
            return $orders;
        }catch(Exception $e){
            throw $e;
        }
    }
    public function customerOrders(){
        try{
            $orderModel = new UserOrderModel();
            $orders = $orderModel->orderDetails();
            return $orders;
        }catch(Exception $e){
            throw $e;
        }
    }

   function authenticateAdmin($username, $password) {
    $query = 'SELECT username,password,salt FROM tbl_user WHERE username = ? AND role_id = 1';
    $params = array($username);

    // Database connection
    $stmt = mysqli_prepare($this->connection, $query);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, 's', ...$params);
        // Execute the query
        mysqli_stmt_execute($stmt);
        // Store the result
        mysqli_stmt_store_result($stmt);
        // Check if any rows are returned
        if (mysqli_stmt_num_rows($stmt) > 0) {
            // Bind the result variables
            mysqli_stmt_bind_result($stmt, $dbUsername, $dbPassword, $dbSalt);
            // Fetch the user details
            mysqli_stmt_fetch($stmt);

            if (authentication::Authenticate($dbPassword, $dbSalt, $password)) {
                $_SESSION['username'] = $username;
                setcookie('admin_username', $username, time() + (86400 * 2), "/"); // Set a cookie that expires in 2 days
                header("location: index.php");
                exit();
            } else {
                header("location: login.php");
                exit();
            }
        } else {
            // No matching user found
            header("location: login.php");
            exit();
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle statement preparation error
        die('Error sa bind statement change params or query to debug');
    }
    }
}
?>
