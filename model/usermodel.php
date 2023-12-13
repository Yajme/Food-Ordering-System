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
     * Registers a new address for a customer.
     *
     * @param array $data The data containing the address information.
     *                    The array should have the following keys:
     *                    - customerid: The ID of the customer.
     *                    - buildingNumber: The building number of the address.
     *                    - streetNumber: The street number of the address.
     *                    - barangay: An array containing the name of the barangay.
     *                    - municipality: An array containing the name of the municipality.
     *                    - postalCode: The postal code of the address.
     * @return int The number of rows affected by the insert query.
     * @throws Exception If there is an error registering the address.
     */
    public function registerAddress($data=array()){
        try{
            $this->connection->autocommit(FALSE);
            $customerid = $this->escape_string($data['customerid']);
            $buildingno = $this->escape_string($data['buildingNumber']);
            $street = $this->escape_string($data['streetNumber']);
            $barangay = $this->escape_string($data['barangay']['name']);
            $municipality = $this->escape_string($data['municipality']['name']);
            $postalcode = $this->escape_string($data['postalCode']);

   
            $query = "INSERT INTO `tbl_customer_address`(`customer_id`, `building_no`, `street_number`, `barangay`, `municipality`, `postal_code`) VALUES ($customerid,'$buildingno','$street','$barangay','$municipality','$postalcode')";
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to register address" . $this->connection->error);
            $this->connection->commit();
            return $rows;
        }catch(Exception $e){
            $this->connection->rollback();
            throw $e;
        }
        
    }

    /**
     * Retrieves the address of a customer based on the provided parameters.
     *
     * @param mixed $params The parameters used to retrieve the address.
     * @return array The array of address records.
     * @throws Exception If unable to retrieve the address.
     */
    public function getAddress($params){
        try{
            $customerid = $this->escape_string($params);
            $query = "SELECT * FROM view_customer_address WHERE customer_id ='$customerid' ORDER BY `default` DESC";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to get address");
            return $rows;
        }catch(Exception $e){
            throw $e;
        }
    }
    /**
     * Selects the primary address for a given customer ID.
     *
     * @param mixed $params The customer ID.
     * @return array The primary address details.
     * @throws Exception If unable to retrieve the address.
     */
    public function selectPrimaryAddress($params){
        try{
            $customerid = $this->escape_string($params);
            $query = "SELECT * FROM view_customer_address WHERE customer_id ='$customerid' AND `default` = 1";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to get address");
            return $rows;
        }catch(Exception $e){
            throw $e;
        }
    }
    /**
     * Selects an address from the database based on the given parameters.
     *
     * @param mixed $params The parameters used to select the address.
     * @return array The selected address information.
     * @throws Exception If unable to get the address.
     */
    public function selectAddress($params){
        try{
            $addressid = $this->escape_string($params);
            $query = "SELECT * FROM view_customer_address WHERE ID ='$addressid'";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to get address");
            return $rows;
        }catch(Exception $e){
            throw $e;
        }
    }
    /**
     * Retrieves all payment methods from the database.
     *
     * @return array An array of payment method records.
     * @throws Exception If unable to retrieve payment methods.
     */
    public function viewPaymentMethod(){
        try{
            $query = "SELECT * FROM tbl_payment_method";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to get payment method");
            return $rows;
        }catch(Exception $e){
            $this->connection->rollback();
            throw $e;
        }
    }
    /**
     * Checks out the customer's cart.
     * @param array $params The parameters for checking out the cart.
     *                  - customerid: The ID of the customer. [0]
     *                  - paymentmethod: The ID of the payment method.[1]
     *                  - address: The address of the customer.[2]
     *                  - cart: The cart items.[3]
     *                  - total: The total amount of the cart items.[4]
     *                   
     * @return void.
     * @throws Exception If unable to checkout.
     */
    public function checkout($params=array()){
        try{
            $this->connection->autocommit(FALSE);
            $customerid = $this->escape_string($params['customerid']);
            $paymentmethod = $this->escape_string($params['payment']);
            $total = floatval($params['total']);
            
            $addressid = $this->escape_string($params['address']['ID']);
            /**
             * Checkout 
             * @param $customerid, @param $paymentmethod, @param $amount, @param $orderid OUT
             */
            
            $query = "CALL Checkout('$customerid','$paymentmethod','$total', '$addressid',@orderid);";

            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to checkout. " . $this->connection->error);
            $query = "SELECT @orderid as orderid";
            $rows = $this->read($query);
            if(!$rows) throw new Exception("Unable to checkout. " . $this->connection->error);
            /**
             * Inserts the cart items into the order details table.
             *
             * @param array $params The parameters containing the cart items and order ID.
             * @throws Exception If unable to checkout.
             * @return void
             */
            $cart = $params['cart'];
            $rows = $rows[0]['orderid'];
            $query = "INSERT INTO `tbl_invoice`(`order_id`, `product_id`, `quantity`) VALUES";
            
            $values = array();
            foreach ($cart as $item) {
                $productid = $this->escape_string($item['product_id']);
                $quantity = $this->escape_string($item['quantity']);
                $values[] = "($rows, $productid, $quantity)";
            }

            $query .= implode(", ", $values) . ";";
  
            $rows = $this->execute($query);
            if(!$rows) throw new Exception("Unable to checkout" . $this->connection->error);
            $this->connection->commit();
            return $rows;
        }catch(Exception $e){
            $this->connection->rollback();
            throw $e;
        }
    }
}

?>