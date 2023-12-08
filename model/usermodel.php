<?php
include_once('../../db/connection.php');
/*
@class userModel only scopes customer not admin
*/
/**
 * FILEPATH: /d:/xampp/htdocs/System/model/usermodel.php
 *
 * The UserModel class represents a model for managing user data in the system.
 * It extends the Database class and provides methods for selecting, signing up, adding to cart, viewing cart, counting cart, and deleting from cart.
 */

class UserModel extends Database{

 
    public function __construct(){
        parent::__construct();
    }

    /**
     * Selects a user from the database based on the given username.
     *
     * @param string $username The username of the user to select.
     * @return array The selected user's information.
     * @throws Exception If the username or password is invalid.
     */
    public function selectUser($username){
        $username = $this->escape_string($username);
        $query = "SELECT * FROM view_user_customer WHERE username= '$username'";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("Invalid Username or password");
        return $rows;
    }
    /**
     * Registers a new user in the system.
     *
     * @param array $data The user data to be saved.
     * @return int The number of rows affected by the query.
     * @throws Exception If unable to create the user account.
     */
    public function signupUser($data=array()){
        try{
            $this->connection->autocommit(FALSE);
            var_dump($data);
            //To be inserted to tbl_customer
            $firstname = $this->escape_string($data['firstname']);
            $lastname = $this->escape_string($data['lastname']);
            $phone = $this->escape_string($data['phone']);
            //To be insert to tbl_customer_address
            $buildingno = $this->escape_string($data['buildingNumber']);
            $street = $this->escape_string($data['streetNumber']);
            $barangay = $this->escape_string($data['barangay']['name']);
            $municipality = $this->escape_string($data['municipality']['name']);
            $postalcode = $this->escape_string($data['postalCode']);
            //To be inserted to tbl_user
            $email = $this->escape_string($data['email']);
            $username = $this->escape_string($data['username']);
            $password = $this->escape_string($data['basePassword']);
            $salt = authentication::generateSalt();
            $password = authentication::hashPassword($password,$salt);
            $query = "CALL RegisterUser('$username','$password','$salt','$email','$firstname','$lastname','$phone','$buildingno','$street','$barangay','$municipality','$postalcode')";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to create account");
            $this->connection->commit();
            return $rows;
        }catch(Exception $e){
            $this->connection->rollback();
            throw $e;
        }
    }
    /**
     * Adds a product to the customer's cart.
     *
     * @param array $params An array containing the product ID, customer ID, and quantity.
     * @return mixed Returns the result of the database operation.
     * @throws Exception If there is an error adding the product to the cart.
     */
    public function addToCart($params=array()){
        
        try{
            $this->connection->autocommit(FALSE);
            $productid = $this->escape_string($params[0]['productid']);
            $customerid = $this->escape_string($params[0]['customerid']);
            $quantity = $this->escape_string($params[0]['quantity']);
            $query = "SELECT * FROM tbl_customer_cart WHERE product_id = $productid AND customer_id = $customerid";
            $rows = $this->read($query);
            if($rows){
                $quantity = $rows[0]['quantity'] + $quantity;
                $query = "UPDATE `tbl_customer_cart` SET `quantity`=$quantity, `modified_at`=now(), `deleted_at` =NULL WHERE product_id = $productid AND customer_id = $customerid";
                $rows = $this->execute($query);
                if(!$rows) throw new Exception("Unable to add to cart");
                $this->connection->commit();
                return $rows;
            }
            $query = "INSERT INTO `tbl_customer_cart`(`product_id`, `customer_id`,`quantity`) VALUES ($productid,$customerid,$quantity)";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to add to cart");
            $this->connection->commit();
        return $rows;
        }catch(Exception $e){
            $this->connection->rollback();
            throw $e;
        }
        
    }

    /**
     * Retrieves the cart items for a specific customer.
     *
     * @param int $customerid The ID of the customer.
     * @return array The cart items for the customer.
     * @throws Exception If the cart is empty.
     */
    public function viewCart($customerid){
        $customerid = $this->escape_string($customerid);
        $query = "SELECT * FROM view_customer_cart WHERE customer_id = $customerid";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("Cart is empty!");
        return $rows;
    }
    /**
     * Counts the number of items in the cart for a given customer.
     *
     * @param int $customerid The ID of the customer.
     * @return array The result of the query, containing the count of items in the cart.
     * @throws Exception If the cart is empty.
     */
    public function countCart($customerid){
        $customerid = $this->escape_string($customerid);
        $query = "SELECT count(*) as CartCount FROM view_customer_cart WHERE customer_id = $customerid";
        $rows = $this->read($query);
        if(!$rows) throw new Exception("Cart is empty!");
        return $rows;
    }

    /**
     * Deletes a product from the customer's cart.
     *
     * @param array $params The parameters for deleting the product from the cart.
     *                      - productid: The ID of the product to be deleted.
     *                      - customerid: The ID of the customer.
     * @return int The number of rows affected by the deletion.
     * @throws Exception If unable to delete the product from the cart.
     */
    public function deleteCart($params=array()){
        try{
            $this->connection->autocommit(FALSE);
            $productid = $this->escape_string($params['productid']);
            $customerid = $this->escape_string($params['customerid']);
            $query = "UPDATE `tbl_customer_cart` SET deleted_at = now(), quantity = 0 WHERE product_id = $productid AND customer_id = $customerid";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to delete from cart");
            $this->connection->commit();
            return $rows;
        }catch(Exception $e){
            $this->connection->rollback();
            throw $e;
        }
    }
}

?>