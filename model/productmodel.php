<?php
include_once('../../db/connection.php');
//SELECT Category, COUNT(Category) as Products FROM `view_availableproducts` GROUP BY Category
class ProductModel extends Database {
    public function __construct(){
        parent::__construct();
    }

    public function selectAllProducts(){
        $query = "SELECT * FROM view_availableproducts";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("No products found");
        return $rows;
    }

    public function selectProductByCategory($category){
        
        if(is_array($category)){
            $params = '';
            foreach($category as $cat){

                    $cat = $this->escape_string($cat);
                    $params .= "'$cat',";
                
                
            }
            $params = rtrim($params,',');

            $query = "SELECT * FROM view_availableproducts WHERE category IN ($params)";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("No products found");
            return $rows;
        }

        $category = $this->escape_string($category);
        $query = "SELECT * FROM view_availableproducts WHERE category = '$category'";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("No products found");
        return $rows;
    }

    public function selectProductBySearch($search){
        $search = $this->escape_string($search);
        $query = "SELECT * FROM view_availableproducts WHERE `Product Name` LIKE '%$search%'";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("No products found");
        return $rows;
    }

    public function loadCategories(){
        $query = "SELECT Category, COUNT(Category) as Products, image_path FROM `view_availableproducts` GROUP BY Category";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("No products found");
        return $rows;
    }

    public function loadFeaturedProducts(){
        $query = "SELECT * FROM view_featured_products ORDER BY RAND()";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("No products found");
        return $rows;
    }

    public function recentProducts(){
        $query = "SELECT * FROM view_availableproducts ORDER BY created_at DESC LIMIT 5";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("No products found");
        return $rows;
    }
    public function selectProductByPrice($min,$max){
        $min = $this->escape_string($min);
        $max = $this->escape_string($max);
        $query = "SELECT * FROM view_availableproducts WHERE price BETWEEN $min AND $max";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("No products found");
        return $rows;
    }
}

?>