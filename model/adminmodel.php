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

    public function Login($username,$password){
        try{
            $query = "SELECT * FROM tbl_user WHERE username= '$username'";
            $rows = $this->read($query);

            $adminData = $rows;
            if(!authentication::Authenticate($adminData[0]["password"],$adminData[0]["salt"],$password)) throw new Exception ('Incorrect password');
            setCookie('userid',$adminData[0]["user_id"],time() + 3600, '/');
            $_SESSION['user_name'] = $adminData[0]["userName"];
           header('location: index.php');
        }catch(Exception $e){
            throw $e;
        }
    }
}
?>
