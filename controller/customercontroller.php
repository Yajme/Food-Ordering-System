<?php

require_once ('../../model/usermodel.php');
require_once '../../utils/userinterface.php';
require_once '../../utils/authentication.php';
require_once '../../utils/cookiehandler.php';

interface ICustomer{
   //WIP FOR CART etc
}
abstract class BaseCustomer implements ICustomer, ILogin{
    //Validating user inputs
    public function Login($username,$password){
        if(empty($username)) throw new Exception('Username cannot be empty!');
        if(empty($password)) throw new Exception('Password cannot be empty!');
    }
}
class CustomerController extends BaseCustomer {
    protected $user;
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
            CookieHandler::setCookie('userid',$userData[0]["user_id"],time() + 3600, '/', 'example.com', false, true);
            $_SESSION['user_name'] = $userData[0]["CustomerName"];
           header('location: index.php');
           
        }catch(Exception $e){
            throw $e;
        }
    }
}
?>