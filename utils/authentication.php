<?php

Class authentication{
    public static function Authenticate($BasePassword,$Salt,$InputPassword){
        return ($BasePassword === hash('sha256',($InputPassword.$Salt)));
    }
    public static function  generateSalt($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle($characters), 0, $length);
        return $randomString;
    }
    public static function hashPassword($password,$salt){
        return hash('sha256',($password.$salt));
    }
    
}
?>