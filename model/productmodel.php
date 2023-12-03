<?php
include_once('../db/connection.php');
//SELECT Category, COUNT(Category) as Products FROM `view_availableproducts` GROUP BY Category
class ProductModel extends Database {
    public function __construct(){
        parent::__construct();
    }


}

?>