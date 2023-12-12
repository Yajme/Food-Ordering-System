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
    /**
     * Load count categories available 
     * 
     * This function retrieves all categories along with count of product associated with it from the database 
     * @return array An array of categories with product count and sample image path
     * @throws Exception if there is no products
     */
    public function loadCategories(){
        $query = "SELECT Category, COUNT(Category) as Products, image_path FROM `view_availableproducts` GROUP BY Category";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("No products found");
        return $rows;
    }
    /**
     * Load featured products.
     *
     * This function retrieves all featured products from the database, ordered randomly.
     *
     * @return array An array of featured products. Each product is represented as an associative array.
     * @throws Exception If no products are found.
     */
    public function loadFeaturedProducts(){
        $query = "SELECT * FROM view_featured_products ORDER BY RAND()";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("No products found");
        return $rows;
    }
      /**
     * Get recent products.
     *
     * This function retrieves the 5 most recent available products from the database.
     *
     * @return array An array of recent products. Each product is represented as an associative array.
     * @throws Exception If no products are found.
     */
    public function recentProducts(){
        $query = "SELECT * FROM view_availableproducts ORDER BY created_at DESC LIMIT 5";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("No products found");
        return $rows;
    }
    /**
     * Select products by price.
     *
     * This function retrieves all available products within a certain price range from the database.
     *
     * @param float $min The minimum price.
     * @param float $max The maximum price.
     * @return array An array of products within the price range. Each product is represented as an associative array.
     * @throws Exception If no products are found.
     */
    public function selectProductByPrice($params=array()){
        $min = $this->escape_string($params['min']);    
        $max = $this->escape_string($params['max']);
        $query = "SELECT * FROM view_availableproducts WHERE price BETWEEN $min AND $max";
        $rows = $this->read($query);
        return ($rows) ? $rows : throw new Exception("No products found");
    }
}

?>