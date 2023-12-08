<?php

require_once '../../model/usermodel.php';
require_once '../../utils/userinterface.php';
require_once '../../utils/authentication.php';
require_once '../../model/productmodel.php';

interface ICustomer{
    
    public function Products($Function, $params = array());
    public function Cart($Function, $params = array());
}
abstract class BaseCustomer implements ICustomer, ILogin{
    
    //Validating user inputs
    public function Login($username,$password){
        if(empty($username)) throw new Exception('Username cannot be empty!');
        if(empty($password)) throw new Exception('Password cannot be empty!');
    }

    public function Products($Function, $params = array())
    {
        try{
            return  $this->initializeProductModel(new ProductModel())->$Function($params);
        }catch(Exception $e){
            throw $e;
        }
    }
    public function Cart($Function, $params = array())
    {
        try{
            return  $this->initializeUserModel(new UserModel())->$Function($params);
        }catch(Exception $e){
            throw $e;
        }
    }
    private function initializeProductModel(ProductModel $product){return $product;}
    private function initializeUserModel(UserModel $user){return $user;}
}
class CustomerController extends BaseCustomer {
    protected $user;
    protected $product;
    public function __construct()
    {
        //Initialize Object user in @class UserModel
        $this->user = new UserModel();
    }
    /*
    *@params($username,$password) used for identifying users
    */
     public function Login($username,$password){
        try{
            //Call base Function with @params
            parent::Login($username,$password);
            //GetUser credentials based on @param = $username
            $userData= $this->user->selectUser($username);
            //Static Function for comparing hashed values of password
            if(!authentication::Authenticate($userData[0]["password"],$userData[0]["salt"],$password)) throw new Exception ('Incorrect password');
            //SetsCookie
            setCookie('userid',$userData[0]["user_id"],time() + 3600, '/');
            setCookie('customerid',$userData[0]["customerid"],time() + 3600, '/');
            $_SESSION['user_name'] = $userData[0]["CustomerName"];
           header('location: index.php');
           
        }catch(Exception $e){
            throw $e;
        }
    }
    

    public function Signup($data){
        try{
            $this->user->signupUser($data);
        }catch(Exception $e){
            throw $e;
        }
    }
    /**
     * List of Functions for loading categories and products
     * 1. LoadCategories()
     * 2. LoadFeaturedProducts()
     * 3. recentProducts()
     * 4. loadAvailableProducts()
     * 5. filterbyCategory($categories)
     * 6. filterbyPrice($min,$max)
     * 7. selectProductBySearch($search)
     */
   
    



    public function loadAvailableProducts(){
        try{
            $product = new ProductModel();
            $availableProducts = $product->selectAllProducts();
            return $availableProducts;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function filterbyCategory($categories){
        try{
            $product = new ProductModel();
            $availableProducts = $product->selectProductByCategory($categories);
            return $availableProducts;
        }catch(Exception $e){
            throw $e;
        }
    }
    public function filterbyPrice($min,$max){
        try{
            $product = new ProductModel();
            $availableProducts = $product->selectProductByPrice($min,$max);
            return $availableProducts;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function selectProductBySearch($search){
        try{
            $product = new ProductModel();
            $availableProducts = $product->selectProductBySearch($search);
            return $availableProducts;
        }catch(Exception $e){
            throw $e;
        }
    }
}   
?> 