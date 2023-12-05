<?php
class CookieHandler 
{
    public static function setCookie($name, $value, $expiry = time() + 3600, $path = '/', $domain = null, $secure = false, $httponly = false) {
        setcookie($name, $value, $expiry, $path, $domain, $secure, $httponly);
    }

    public static function getCookie($name) {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    public static function deleteCookie($name) {
        setcookie($name, '', time() - 3600); // Set expiry to a past time to delete the cookie
    }
}
?>