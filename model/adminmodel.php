<?php
include_once('../../db/connection.php');
require_once '../../model/productmodel.php';
class adminProduct extends Database {

    public function addProduct($name, $description, $price, $category,$imagePath) {
        $image = '../../public/assets/'. $imagePath;
        $query = "INSERT INTO tbl_product(product_name, product_description, price, category_id,image_path,created_at) VALUES (?,?,?,?,?,NOW())";
        $params = array($name, $description, $price, $category,$image);
        return $rows = $this->statementBind($query, $params);
        if (!$rows) {
            throw new Exception("Product failed to be inserted!");
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
}
?>
