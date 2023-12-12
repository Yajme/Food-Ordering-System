<?php
interface ILogin{
    public function Login($username,$password);
}
interface ISignup{
    public function Signup($params);
}
?>